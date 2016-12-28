<?php
namespace Infobeans\MultiFilter\Model;

class Session extends \Magento\Framework\Session\SessionManager 
{
    /**
     * Retrieve session name
     *
     * @return string
     */
    public function getName() {
        return session_name();
    }

    /**
     * Set session name
     *
     * @param string $name
     * @return $this
     */
    public function setName($name) {
        session_name($name);
        return $this;
    }
}