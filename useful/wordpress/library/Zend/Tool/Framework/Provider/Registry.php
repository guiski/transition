<?php

require_once 'Zend/Tool/Framework/Provider/Signature.php';

class Zend_Tool_Framework_Provider_Registry implements IteratorAggregate 
{

    protected static $_instance = null;
    
    protected $_providerSignatures = array();
    protected $_providers = array();
    protected $_actions = array();
    
    /**
     * Enter description here...
     *
     * @return Zend_Tool_Framework_Provider_Registry
     */
    public static function getInstance()
    {
        if (self::$_instance === null) {
            self::$_instance = new self();
        }
        
        return self::$_instance;
    }
    
    protected function __construct()
    {
    }
    
    public function addProvider(Zend_Tool_Framework_Provider_Interface $provider)
    {
        $this->_providers[] = $provider;
        return $this;
    }
    
    public function addAction($action)
    {
        if (is_string($action)) {
            $actionName = $action;
            $action = new Zend_Tool_Framework_Provider_Action();
            $action->setName($actionName);
        }
        
        if (!$action instanceof Zend_Tool_Framework_Provider_Action) {
            throw new Zend_Tool_Framework_Provider_Exception('Action must be an instance of Zend_Tool_Framework_Provider_Action or an action name.');
        }
        
        if (!array_key_exists($action->getName(), $this->_actions)) {
            $this->_actions[$action->getName()] = $action;
        }
        
        return $this;
    }
    
    
    
    public function process()
    {
        foreach ($this->_providers as $provider) {
            $providerSignature = new Zend_Tool_Framework_Provider_Signature($provider);
            $this->_providerSignatures[$providerSignature->getName()] = $providerSignature;
        }
        
    }
    
    public function getActions()
    {
        return $this->_actions;
    }
    
    public function getAction($actionName, $createIfNotExist = false)
    {
        if (!in_array($actionName, $this->_actions)) {
            $this->addAction($actionName);
        }
        
        return $this->_actions[$actionName];
    }
    
    public function getProviders()
    {
        
    }
    
    public function getProviderSignatures()
    {
        return $this->_providerSignatures;
    }
    
    public function getProviderSignature($providerName)
    {
        return $this->_providerSignatures[$providerName];
    }
    
    public function getProvider($providerName)
    {
        return $this->_providerSignatures[$providerName]->getProvider();
    }
    
    public function getIterator()
    {
        return array();
    }
    
}
