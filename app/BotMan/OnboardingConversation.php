<?php

namespace App\Botman;

use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Outgoing\Question;

class OnboardingConversation extends Conversation
{
    protected $name;

    protected $email;

    protected $query;

    public function askName()
    {
        $this->ask('Hi! What is your name?', function(Answer $answer) {
            // Save result
            $this->name = $answer->getText();

            $this->say('Nice to meet you '.$this->name);
            $this->askEmail();
        });
    }

    public function askEmail()
    {
        $this->ask('One more thing - what is your email address?', function(Answer $answer) {
            // Save result
            $this->email = $answer->getText();

            $this->say('Great - that is all we need, '.$this->name);
            $this->askHelp();
        });
    }

    public function askHelp()
    {
        $this->ask('How can I help you?', function(Answer $answer) {
            // Save result
            $this->query = $answer->getText();

            $this->say('Your query has been forwarded, we will contact you soon.');
        });
    }

    // public function run()
    // {
    //     // This will be called immediately
    //     $this->askName();
    // }

    public function run()
    {
        // code...

        $question = Question::create('Would you like to negotiate the price of this product')
        ->addButtons([
            Button::create('Yes')->value(1),
            Button::create('No, thank you')->value(0),
        ]);

        $this->ask($question,function($answer)
        {
            $this->say('You said'.$answer->getValue());
        });
    }
}