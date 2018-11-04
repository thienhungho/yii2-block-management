<?php

namespace thienhungho\Block\modules\BlockBase;

use Yii;
use \thienhungho\Block\modules\BlockBase\base\Block as BaseBlock;

/**
 * This is the model class for table "block".
 */
class Block extends BaseBlock
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['name', 'content'], 'required'],
            [['content'], 'string'],
            [['author', 'assign_with', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'language'], 'string', 'max' => 255],
            [['created_by'], 'default', 'value' => get_current_user_id()],
            [['updated_by'], 'default', 'value' => get_current_user_id()],
            [['author'], 'default', 'value' => get_current_user_id()],
            [['language'], 'default', 'value' => get_primary_language()],
            [['assign_with'], 'default', 'value' => 0]
        ]);
    }

    /**
     * @return array
     */
    public function attributeHints()
    {
        return [
            'id' => Yii::t('app', 'Block\'s id, Each block has a unique id, data type integer'),
            'name' => Yii::t('app', 'Block\'s name, max length is 255 character'),
            'content' => Yii::t('app', 'Block\'s content'),
            'author' => Yii::t('app', 'Block\'s author, select author for block'),
            'language' => Yii::t('app', 'Block\'s language, select language for block'),
            'assign_with' => Yii::t('app', 'Block\'s assign with other block different language'),
        ];
    }

}
