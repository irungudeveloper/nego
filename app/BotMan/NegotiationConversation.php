<?php 

namespace App\Botman;

use Illuminate\Http\Request;

use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Outgoing\Question;

use Illuminate\Support\Facades\Validator;

use App\Models\Product;
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
    protected $percentage;

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
				$question = Question::create('I can offer 1% off of the product, will this suffice?')->addButtons(
							[
								Button::create('Yes')->value(1),
								Button::create('No')->value(0),
							]);

				$this->ask($question,function($answer)
				{
					if ($answer->getValue() == 0) 
					{
					$this->ask('Please enter the percentage discount you wish to gain', function(Answer $answer)
						{
							$this->percentage = $answer->getText();
							$this->say('You said '. $this->percentage);
						});
					}
				});
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

   		if ((($details->product_retail_price)-($details->product_retail_price * ($percentage/100))) > ($details->product_final_price) ) 
   		{
   			return 1;
   		}
   		else
   		{

   			return 0;
   		}

   }

   public function generateDiscountCode()
   {
   	// code...

   		$percentage = 50;
   		$details = $this->getProduct();

   		$id = $details->id;

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
            $discount->product_id = $id;
            $discount->percentage = $percentage;
            $discount->user_id = Auth::user()->id;

            try 
            {
                $discount->save();
                return response()->json($discount);
            } 
            catch (Exception $e) 
            {
                return response()->json('Not able to create discount code');
            }
   		}
   		else
   		{
   			return response()->json('Too high a percentage');
   		}

   }

   public function midNegotiation($percentage)
   {
   	// code...

   		// $question = 

   }

	public function run()
	{
		// code...
		$this->askName();
		
	}
}