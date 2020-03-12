<?php


class Currency
{
    private $arr;
    private $date;

    public function __construct(\DateTime $date, array $arr)
    {
        $this->arr = $arr;
        $this->date = $date;
    }

    /**
     * @return array
     */
    public function getArr(): array
    {
        return $this->arr;
    }

    /**
     * @return DateTime
     */
    public function getDate(): DateTime
    {
        return $this->date;
    }

    public static function getCurrency(DateTime $date = null): ?Currency
    {
        if ($date == null) {
            $date = new DateTime();
        }
        $currencyCache = new CurrencyCache();
        $currency = $currencyCache->getCurrency($date);

        if ($currency == null) {
            $currencyDataBase = new CurrencyDataBase();
            $currency = $currencyDataBase->getCurrency($date);

            if ($currency == null) {
                $currencyUrl = new CurrencyUrl();
                $currency = $currencyUrl->getCurrency($date);
                if ($currency == null) return null;

                $currencyCache->setCurrency($currency);
                $currencyDataBase->setCurrency($currency);
                return $currency;
            }

            $currencyCache->setCurrency($currency);
            return $currency;
        }

        return $currency;
    }
}