<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use common\components\Utility;

/**
 * This is the model class for table "challenge_category".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $category_type_id
 * @property string $created_at
 * @property string $updated_at
 *
 * @property ChallengeCategoryType $categoryType
 */
class ChallengeCategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'challenge_category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'category_type_id'], 'required'],
            [['description'], 'string'],
            [['category_type_id'], 'integer'],
            [['created_at', 'updated_at'], 'datetime', 'format' => 'php:Y-m-d H:i:s'],
            [['name'], 'string', 'max' => 255],
            [['name'], 'unique'],
            [['category_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => ChallengeCategoryType::class, 'targetAttribute' => ['category_type_id' => 'id']],
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'value' => Utility::getDateNow(),
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'description' => 'Описание',
            'category_type_id' => 'Тип категории',
            'created_at' => 'Создано',
            'updated_at' => 'Изменено',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoryType()
    {
        return $this->hasOne(ChallengeCategoryType::class, ['id' => 'category_type_id']);
    }
}
