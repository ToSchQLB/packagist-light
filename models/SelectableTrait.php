<?php
/**
 * Created by PhpStorm.
 * User: Toni.Schreiber
 * Date: 17.01.2019
 * Time: 10:44
 */

namespace app\models;

use yii\db\Expression;
use yii\helpers\ArrayHelper;

/**
 * Dieser Trait ist für alle auswählbaren Models (z.Bsp. Rollen, Gruppen, Tags, ...) gedacht.
 * @package app\models
 */
trait SelectableTrait
{
    /**
     * key Spalte für die all() rückgabe
     *
     * @var string
     */
    protected static $idColumn = 'id';
    /**
     * Spaltenname Value der all() Rückgabe
     *
     * @var string|Expression
     */
    protected static $valueColumn = 'name';

//    protected static $valueExpression   = false;
    /**
     * Spaltenname, meist gleich mit $valueColumn. Wenn $valueColumn ein Ausdruck ist bitte Ergebnisnamen angeben
     *
     * @var string
     */
    protected static $valueExpressionName = 'name';

    /**
     * gibt alle Ellemente eines ActiveRecords als Array [id => value] zurück, sodass Sie direkt für Filter in GridViews
     * oder Wertevorgaben für DropdownFelder bzw Select2 genutzt werden können
     *
     * @return array
     */
    public static function all()
    {
        $elements = self::find()
            ->select([
                self::$idColumn,
                isset(self::$valueExpression) == false
                    ? self::$valueColumn
                    : new Expression(self::$valueExpression . ' AS ' . self::$valueExpressionName),
            ])
            ->asArray()
            ->all();

        return ArrayHelper::map(
            $elements,
            self::$idColumn,
            isset(self::$valueExpression) == false
                ? self::$valueColumn
                : self::$valueExpressionName
        );
    }
}