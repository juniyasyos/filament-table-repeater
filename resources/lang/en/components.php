<?php

return [
    'validation' => [
        'required' => 'This field is required.',
        'unique' => 'This value already exists.',
        'email' => 'Please provide a valid email address.',
        'numeric' => 'This field must be a number.',
        'min' => 'This field must be at least :min characters.',
        'max' => 'This field must not exceed :max characters.',
    ],

    'repeater' => [
        'empty' => [
            'label' => 'No records',
        ],
        'row_actions' => [
            'label' => 'Row Actions',
        ],
        'add_action' => [
            'label' => 'Add',
            'tooltip' => 'Add a new row',
        ],
        'delete_action' => [
            'label' => 'Delete',
            'tooltip' => 'Delete this row',
        ],
        'clone_action' => [
            'label' => 'Clone',
            'tooltip' => 'Duplicate this row',
        ],
        'move_up_action' => [
            'label' => 'Move Up',
            'tooltip' => 'Move up',
        ],
        'move_down_action' => [
            'label' => 'Move Down',
            'tooltip' => 'Move down',
        ],
        'reorder_action' => [
            'label' => 'Reorder',
            'tooltip' => 'Drag to reorder',
        ],
    ],

    'messages' => [
        'no_items' => 'No items to display',
        'loading' => 'Loading...',
        'error' => 'An error occurred',
        'confirm_delete' => 'Are you sure you want to delete this row?',
    ],
];
