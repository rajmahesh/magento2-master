<?php
namespace Infobeans\MultiFilter\Model\Source;

use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;

class Mode extends AbstractSource 
{
    /**
     * Retrieve option array
     *
     * @return array
     */
    public function getAllOptions() {
        return [
            ['value' => '0', 'label' => __('--Select An Option--')],
            ['value' => 'range', 'label' => __('Range')],
            ['value' => 'slider', 'label' => __('Slider')]
        ];
    }
}