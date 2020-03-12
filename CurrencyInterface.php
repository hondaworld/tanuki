<?php


interface CurrencyInterface
{
    public function getCurrency(DateTime $date): ?Currency;
    public function setCurrency(Currency $currency);
}