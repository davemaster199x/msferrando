<?php

require_once('FormProcessor.php');

$form = array(
    'subject' => 'New Form Submission',
    'email_message' => 'You have a new form submission',
    'success_redirect' => '',
    'sendIpAddress' => true,
    'email' => array(
    'from' => '',
    'to' => ''
    ),
    'fields' => array(
    'name' => array(
    'order' => 1,
    'type' => 'string',
    'label' => 'Full Name:',
    'required' => true,
    'errors' => array(
    'required' => 'Field \'Full Name:\' is required.'
    )
    ),
    'email-1' => array(
    'order' => 2,
    'type' => 'string',
    'label' => 'Email Address:',
    'required' => false,
    'errors' => array(
    'required' => 'Field \'Email Address:\' is required.'
    )
    ),
    'phone' => array(
    'order' => 3,
    'type' => 'email',
    'label' => 'Contact Number:',
    'required' => true,
    'errors' => array(
    'required' => 'Field \'Contact Number:\' is required.'
    )
    ),
    'address' => array(
    'order' => 4,
    'type' => 'string',
    'label' => 'Address:',
    'required' => false,
    'errors' => array(
    'required' => 'Field \'Address:\' is required.'
    )
    ),
    'date' => array(
    'order' => 5,
    'type' => 'string',
    'label' => 'Birthdate:',
    'required' => true,
    'errors' => array(
    'required' => 'Field \'Birthdate:\' is required.'
    )
    ),
    'select' => array(
    'order' => 6,
    'type' => 'string',
    'label' => 'select',
    'required' => false,
    'errors' => array(
    'required' => 'Field \'select\' is required.'
    )
    ),
    'agree' => array(
    'order' => 7,
    'type' => 'checkbox',
    'label' => 'I accept the Terms of Service',
    'required' => true,
    'errors' => array(
    'required' => 'Field \'I accept the Terms of Service\' is required.'
    )
    ),
    )
    );

    $processor = new FormProcessor('');
    $processor->process($form);

    ?>