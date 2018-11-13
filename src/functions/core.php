<?php
/**
 * @param $name
 * @param string $language
 * @param bool $condition
 * @param null $function
 *
 * @return null|string
 */
function get_block_content($name, $language = NOT_SET, $condition = true, $function = null)
{
    /* Function will be do first before get block content
     *
     * Example:
     * get_block_content('nav', NOT_SET, is_login(), function(){
     *
     *      return get_block_content('nav_for_login');
     *
     * })
     */
    if ($condition= true) {
        if ($language == NOT_SET) {
            $language = get_current_client_language();
        }
        $block = \thienhungho\Block\models\Block::find()
            ->where(['name' => $name])
            ->andWhere(['language' => $language])
            ->orderBy('id')
            ->one();
        if (!empty($block)) {
            return $block->content;
        } else {
            $block = \thienhungho\Block\models\Block::find()
                ->where(['name' => $name])
                ->andWhere(['language' => get_primary_language()])
                ->orderBy('id')
                ->one();
            if (!empty($block)) {
                return $block->content;
            }
        }
    } else {
        if (is_callable($function)) {
            call_user_func($function);
        }
    }

    return null;
}

/**
 * @param $blocks
 *
 * @return null|string
 */
function get_block_contents($blocks)
{
    $content = null;
    if (is_array($blocks)) {
        foreach ($blocks as $block) {
            if (!empty($block['name'])) {
                $name = $block['name'];
                $language = NOT_SET;
                $condition = true;
                $function = null;
                extract($block);
                $content .= get_block_content($name, $language, $condition, $function);
            }
        }
    }

    return $content;
}