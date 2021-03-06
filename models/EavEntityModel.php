<?php

namespace yeesoft\eav\models;

use Yii;

/**
 * This is the model class for table "{{%eav_entity_model}}".
 *
 * @property integer $id
 * @property string $entity_name
 * @property string $entity_model
 *
 * @property EavAttribute[] $eavAttributes
 */
class EavEntityModel extends \yeesoft\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%eav_entity_model}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['entity_model', 'entity_name'], 'string', 'max' => 127],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('yee', 'ID'),
            'entity_name' => Yii::t('yee', 'Name'),
            'entity_model' => Yii::t('yee/eav', 'Model'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEavAttributes()
    {
        return $this->hasMany(EavAttribute::className(), ['id' => 'entity_id'])
            ->viaTable('{{%eav_entity_attribute}}', ['attribute_id' => 'id'])
            ->orderBy(['order' => SORT_DESC]);
    }
}