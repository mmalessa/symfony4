<?php
namespace App\Domain\Constant;

class DomainStatus
{
    const NEW_AWAITING	= 'new_awaiting';
    const NEW			= 'new';
    const TAKEN			= 'taken';
    const VINDICATION	= 'vindication';
    //const DEACT_PENDING	= 'deact_pending';
    const DEACTIVATED	= 'deactivated';
    const TO_IMPORT		= 'to_import';
    const NOT_DONE		= 'not_done';
    const NOT_EXISTS = 'asdf';

    private static $dictionary = [
        'NEW_AWAITING' => 'oczekujący',
        'NEW' => 'nowy',
        'TAKEN' => 'podjęty',
        'VINDICATION' => 'windykacja',
        'DEACT_PENDING' => 'deact pending',
        'DEACTIVATED' => 'usunięty',
        'TO_IMPORT' => 'do importu',
        'NOT_DONE' => 'not done',
    ];

    public static function getList()
    {
        $oClass = new \ReflectionClass(__CLASS__);
        return array_keys($oClass->getConstants());
    }

    public static function getNameList()
    {
        $keys = self::getList();
        $nameList = array_combine($keys, $keys);
        array_walk($nameList, function(&$v, $k) { $v = self::$dictionary[$k] ?? $v; } );
        return $nameList;
    }

}