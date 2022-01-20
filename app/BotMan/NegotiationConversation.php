<?php 

namespace App\Botman;

use Illuminate\Http\Request;

use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Outgoing\Question;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Notification;
use App\Notifications\FailedNegotiation;
use App\Http\Controllers\TestNotification as Save;

use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\Discount;
use Illuminate\Support\Str;

class NegotiationConversation extends Conversation
{

	protected $name;
    protected $email;
    protected $query;
    protected $product_details;
    protected $system_percentage = 1;
    protected $customer_percentage = 0;
    protected $offer_count = 1;
    protected $product_name;
    protected $user_id;
    protected $product_id;

    public function askName()
    {
        $this->ask('I am the nego-tiator, What is your name?', function(Answer $answer) 
        {
            // Save result
            $this->name = $answer->getText();

            $this->say('Nice to meet you '.$this->name);
            $this->beginNegotiation();
            // $this->askEmail();
        });
    }

    public function beginNegotiation()
    {
    	// code...
    	$question = Question::create('Would you like to negotiate the price of this product')
		->addButtons([
			Button::create('Yes')->value(1),
			Button::create('No, thank you')->value(0),
		]);

		$this->ask($question,function($answer)
		{
			if ($answer->getValue() == 1) 
			{

                if ($this->checkAuth() == 1) 
                {
                    // code...
                    $this->midNegotiation();
                }
                else
                {
                    $question = Question::create('Please Login to your account / Create an account to begin negotiations')->addButtons(
                        [
                            
                            Button::create('No, thank you')->value(0),
                        
                        ]);
                    
                    $this->ask($question,function($answer)
                        {
                            if ($answer->getValue()==0) 
                            {
                                // code...
                                $this->thankYou();
                            }
                        });
                }

			}
            else
            {
                $this->thankYou();
            }
			// $this->say('You said'.$answer->getValue());
		});
    }

    public function getProduct()
    {
    	// code...

    	$this->product_details = Product::findOrFail(Session::get('product_id'));

    	// return response()->json($this->product_details);

    	return $this->product_details;
    }

   public function checkValidity($percentage)
   {
   	// code...

   		$details = $this->getProduct();
        $this->product_name = $details->product_name;
        $this->user_id = $details->user_id;

   		if ((($details->product_retail_price)-($details->product_retail_price * ($percentage/100))) > ($details->product_final_price) ) 
   		{
   			return 1;
   		}
   		else
   		{

   			return 0;
   		}

   }

   public function checkAuth()
   {
       // code...

        if (Auth::check()) 
        {
            return 1;
        }
        else
        {
            return 0;
        }

   }

   public function generateDiscountCode($percentage)
   {
   	// code...

   		// $percentage = 50;
   		$details = $this->getProduct();

   		$this->product_id = $details->id;

   		if ($this->checkValidity($percentage) == 1) 
   		{
   			$random = Str::random(8);

            while (count(Discount::where('code',$random)->get()) > 0) 
            {
                $random = Str::random(8);
            }
            
            $discount = new Discount;
            $discount->code = $random;
            $discount->active = 1;
            $discount->product_id = $this->product_id;
            $discount->percentage = $percentage;
            $discount->user_id = Auth::user()->id;

            try 
            {
                $discount->save();
                
                $this->ask('Please use the discount code '.$discount->code.' upon checkout to activate your discount',function(Answer $answer)
                {
                    $this->thankYou();
                });

            } 
            catch (Exception $e) 
            {
                $this->ask('Cannot generate discount code at the moment, please ty again later', function(Answer $answer)
                {
                    $this->thankYou();
                });
            }
   		}
   		else
   		{
   			$this->thankYou();
   		}

   }

   public function midNegotiation()
   {
   	// code...
        // $this->percentage = 1;

                $question = Question::create('I can offer '.$this->system_percentage.'% off of the product, will this suffice?')->addButtons(
                            [
                                Button::create('Yes')->value(1),
                                Button::create('No')->value(0),
                            ]);

                $this->ask($question,function($answer)
                {
                    if ($answer->getValue() == 0) 
                    {
                        $this->negotiationLoop();
                    }
                    else
                    {
                        $this->generateDiscountCode($this->system_percentage);   
                    }
                });

   }


   public function negotiationLoop()
   {
       // code...
        $this->ask('Please enter the percentage discount you wish to gain', function(Answer $answer)
        {
            $this->customer_percentage = (int)$answer->getText();

                if ($this->offer_count < 3) 
                {
                    // code...

                    $this->offer1();

                   // $this->ask('the offer count is '.$this->offer_count, function(Answer $answer)
                   // {

                   // });
                }
                else
                {
                    if($this->checkValidity($this->customer_percentage) == 1)
                    {
                        $this->generateDiscountCode($this->customer_percentage);
                    }
                    else
                    {
                        $this->offer4();
                    }
                }

        });

   }

    public function offer1()
   {
       // code...

        $this->offer_count++;

        if ($this->checkValidity($this->system_percentage+0.45) == 1) 
        {
            $this->system_percentage +=0.45;
        }

        $question = Question::create('Unfortunately, I cannot accept your offer of '.$this->customer_percentage.'% Would you consider accepting a '.($this->system_percentage).'% discount on the product')->addButtons(
            [
                Button::create('Yes')->value(1),
                Button::create('No')->value(0),
            ]);

        $this->ask($question,function($answer)
        {
            if ($answer->getValue() == 1) 
            {
                // code...
                $this->generateDiscountCode($this->system_percentage);
            }
            else
            {

                $this->ask('What is your counter offer',function(Answer $answer)
                {
                    $this->customer_percentage = (int)$answer->getText();
                    $this->offer2();
                    // $this->breakDown();
                });
            }
        });

   }

    public function offer2()
   {
       // code...

        $this->offer_count++;

        if ($this->checkValidity($this->system_percentage+0.45) == 1) 
        {
            $this->system_percentage +=0.45;
        }

        $question = Question::create('Unfortunately, I cannot accept your offer of '.$this->customer_percentage.'% Would you consider accepting a '.($this->system_percentage).'% discount on the product')->addButtons(
            [
                Button::create('Yes')->value(1),
                Button::create('No')->value(0),
            ]);

        $this->ask($question,function($answer)
        {
            if ($answer->getValue() == 1) 
            {
                // code...
                $this->generateDiscountCode($this->system_percentage);
            }
            else
            {

                $this->ask('What is your counter offer',function(Answer $answer)
                {
                    $this->customer_percentage = (int)$answer->getText();
                    $this->offer3();
                    
                });
            }
        });

   }

   public function offer3()
   {
       // code...

        $this->offer_count++;

        if($this->checkValidity($this->customer_percentage) == 1)
        {
           $this->generateDiscountCode($this->customer_percentage); 
        }
        else
        {
            
            if ($this->checkValidity($this->system_percentage+0.45) == 1) 
            {
                $this->system_percentage +=0.45;
            }

            $question = Question::create('Unfortunately, I cannot accept your offer of '.$this->customer_percentage.'% Would you consider accepting a '.($this->system_percentage).'% discount on the product')->addButtons(
                [
                    Button::create('Yes')->value(1),
                    Button::create('No')->value(0),
                ]);

            $this->ask($question,function($answer)
            {
                if ($answer->getValue() == 1) 
                {
                    // code...
                    $this->generateDiscountCode($this->system_percentage);
                }
                else
                {
                    $this->ask('What is your counter offer',function(Answer $answer)
                    {
                        $this->customer_percentage = (int)$answer->getText();
                        $this->offer4();
                    });
                }
            });

        }

   }

   public function offer4()
   {
       // code...

        $this->offer_count++;

        if($this->checkValidity($this->customer_percentage) == 1)
        {
           $this->generateDiscountCode($this->customer_percentage); 
        }
        else
        {
            
            if ($this->checkValidity($this->system_percentage+0.45) == 1) 
            {
                $this->system_percentage +=0.45;
            }

            $question = Question::create('Unfortunately, I cannot accept your offer of '.$this->customer_percentage.'% Would you consider accepting a '.($this->system_percentage).'% discount on the product')->addButtons(
                [
                    Button::create('Yes')->value(1),
                    Button::create('No')->value(0),
                ]);

            $this->ask($question,function($answer)
            {
                if ($answer->getValue() == 1) 
                {
                    // code...
                    $this->generateDiscountCode($this->system_percentage);
                }
                else
                {
                   $this->ask('What is your counter offer',function(Answer $answer)
                    {
                        $this->customer_percentage = (int)$answer->getText();
                        $this->offer5();
                    });
                }
            });

        }

   }

   public function offer5()
   {
       // code...

        $this->offer_count++;

        if($this->checkValidity($this->customer_percentage) == 1)
        {
           $this->generateDiscountCode($this->customer_percentage); 
        }
        else
        {
            
            if ($this->checkValidity($this->system_percentage+0.45) == 1) 
            {
                $this->system_percentage +=0.45;
            }

            $question = Question::create('Unfortunately, I cannot accept your offer of '.$this->customer_percentage.'% Would you consider accepting a '.($this->system_percentage).'% discount on the product')->addButtons(
                [
                    Button::create('Yes')->value(1),
                    Button::create('No')->value(0),
                ]);

            $this->ask($question,function($answer)
            {
                if ($answer->getValue() == 1) 
                {
                    // code...
                    $this->generateDiscountCode($this->system_percentage);
                }
                else
                {
                    $this->ask('What is your counter offer',function(Answer $answer)
                    {
                        $this->customer_percentage = (int)$answer->getText();
                        $this->offer6();
                    });
                }
            });

        }

   }

   public function offer6()
   {
       // code...

        $this->offer_count++;

        if($this->checkValidity($this->customer_percentage) == 1)
        {
           $this->generateDiscountCode($this->customer_percentage); 
        }
        else
        {
            
            if ($this->checkValidity($this->system_percentage+0.45) == 1) 
            {
                $this->system_percentage +=0.45;
            }

            $question = Question::create('Unfortunately, I cannot accept your offer of '.$this->customer_percentage.'% Would you consider accepting a '.($this->system_percentage).'% discount on the product')->addButtons(
                [
                    Button::create('Yes')->value(1),
                    Button::create('No')->value(0),
                ]);

            $this->ask($question,function($answer)
            {
                if ($answer->getValue() == 1) 
                {
                    // code...
                    $this->generateDiscountCode($this->system_percentage);
                }
                else
                {
                   $this->breakDown();
                }
            });

        }

   }

   public function breakDown()
   {
       // code...
        $question = Question::create('I apologize we could not find a common ground, would you consider negoiating with the merchant directly?')->addButtons(
            [
                Button::create('Yes, I would')->value(1),
                Button::create('No, thank you')->value(0),
            ]);

        $this->ask($question,function($answer)
        {
            if ($answer->getValue() == 1) 
            {
                $this->getEmail();
            }
            else
            {
                $this->thankYou();
            }
        });

   }

   public function getEmail()
   {
       // code...
        $this->ask('Please provide your email and the merchant will contact you shortly', function(Answer $answer)
        {   
            $this->email = $answer->getText();

            $save = new Save;
            $status = 0;
            $save->store($this->user_id,Auth::user()->id,$this->product_details->id,$this->customer_percentage,$status);

            $contact_data = [
                                'user_name'=>$this->name,
                                'user_email'=>$this->email,
                                'product_name'=>$this->product_name,
                                'percentage_discount'=>$this->customer_percentage,
                                'thank_you'=>'Thank you for using this platform.',
                            ];

            $user = User::findOrFail($this->user_id);

            // $user->notify(new FailedNegotiation($contact_data));
            Notification::send($user, new FailedNegotiation($contact_data));

            $this->thankYou();

        });
   }

   public function thankYou()
   {
       // code...
        $question = Question::create('It was a pleasure meeting you '.$this->name);

        $this->ask($question,function(Answer $answer)
        {
            $this->askName();
        });

   }

	public function run()
	{
		// code...
		$this->askName();
		
	}
}