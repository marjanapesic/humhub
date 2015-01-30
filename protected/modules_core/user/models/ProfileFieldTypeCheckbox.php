<?php

/**
 * ProfileFieldTypeCheckbox handles checkbox profile fields.
 */
class ProfileFieldTypeCheckbox extends ProfileFieldType {

    /**
     * Rules for validating the Field Type Settings Form
     *
     * @return type
     */
    public function rules()
    {
        return array( 
        );
    }

    /**
     * Returns Form Definition for edit/create this field.
     *
     * @return Array Form Definition
     */
    public function getFormDefinition($definition = array()) {
        return parent::getFormDefinition(array(
                    get_class($this) => array(
                        'type' => 'form',
                        'title' => Yii::t('UserModule.models_ProfileFieldTypeCheckbox', 'Checkbox field options'),
                        'elements' => array(  
                        )
        )));
    }
    
    /**
     * Saves this Profile Field Type
     */
    public function save() {

        $columnName = $this->profileField->internal_name;

        // Try create column name
        if (!Profile::model()->columnExists($columnName)) {
            $sql = "ALTER TABLE profile ADD `" . $columnName . "` boolean;";
            $this->profileField->dbConnection->createCommand($sql)->execute();
        }

        parent::save();
    }

    /**
     * Returns the Field Rules, to validate users input
     *
     * @param type $rules
     * @return type
     */
    public function getFieldRules($rules = array())
    {
        $rules[] = array($this->profileField->internal_name, 'safe');

        return parent::getFieldRules($rules);
    }
    
    public function getFieldFormDefinition()
    {
        return array($this->profileField->internal_name => array(
            'type' => 'checkbox',
        ));
    }
}

?>
