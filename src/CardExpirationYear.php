<?php

namespace LVR\CreditCard;

use LVR\CreditCard\Cards\Card;
use Illuminate\Contracts\Validation\Rule;

class CardExpirationYear implements Rule
{
    const MSG_CARD_EXPIRATION_YEAR_INVALID = 'validation.credit_card.card_expiation_year_invalid';

    /**
     * Month field name.
     *
     * @var string
     */
    protected $month;

    /**
     * CardExpirationYear constructor.
     *
     * @param string $month
     */
    public function __construct(string $month)
    {
        $this->month = $month;
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
        return Card::isValidExpirationDate($value, $this->month);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return static::MSG_CARD_EXPIRATION_YEAR_INVALID;
    }
}
