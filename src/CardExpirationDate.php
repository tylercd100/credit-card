<?php

namespace LVR\CreditCard;

use Illuminate\Support\Carbon;
use LVR\CreditCard\Cards\Card;
use Illuminate\Contracts\Validation\Rule;

class CardExpirationDate implements Rule
{
    const MSG_CARD_EXPIRATION_DATE_INVALID = 'validation.credit_card.card_expiation_date_invalid';
    const MSG_CARD_EXPIRATION_DATE_FORMAT_INVALID = 'validation.credit_card.card_expiation_date_format_invalid';

    protected $message;

    /**
     * Date field format.
     *
     * @var string
     */
    protected $format;

    /**
     * CardExpirationDate constructor.
     *
     * @param string $format Date format
     */
    public function __construct(string $format)
    {
        $this->message = static::MSG_CARD_EXPIRATION_DATE_INVALID;
        $this->format = $format;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string $attribute
     * @param  mixed $value
     *
     * @return bool
     */
    public function passes($attribute, $value)
    {
        try {
            $date = Carbon::createFromFormat($this->format, $value);

            return Card::isValidExpirationDate($date->year, $date->month);
        } catch (\InvalidArgumentException $ex) {
            $this->message = static::MSG_CARD_EXPIRATION_DATE_FORMAT_INVALID;

            return false;
        }

        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->message;
    }
}
