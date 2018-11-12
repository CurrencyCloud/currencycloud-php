<?php
namespace CurrencyCloud\Model;

class RequiredFieldEntry {

    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $validationRule;

    public function __construct($name, $validationRule)
    {
        $this->name = $name;
        $this->validationRule = $validationRule;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getValidationRule()
    {
        return $this->validationRule;
    }

}