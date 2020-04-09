<?php
/**
 * Build a configuration array to pass to `Hybridauth\Hybridauth`
 */

$config = [
  /**
   * Set the Authorization callback URL to https://path/to/hybridauth/examples/example_06/callback.php.
   * Understandably, you need to replace 'path/to/hybridauth' with the real path to this script.
   */
  'callback' => 'http://localhost/ownfcv/syncCallback.php',
  'providers' => [
    'Google' => [
      'enabled' => true,
      'keys' => [
        'key' => '441621451565-7be7gtjffbnnsb8m8n2hrhrfm5v1nlss.apps.googleusercontent.com',
        'secret' => 'KFah_uNlnqO-T_PIBkKgWCJK',
      ],
    ],
    'Twitter' => [
      'enabled' => true,
      'keys' => [
        'id' => 'vy7HZTna4ed2l37XTj676zNfs',
        'secret' => '3hQbb0cPWHId7Xmw1wDlmyI619rZjtzNLOUZElSbxCSXrNtlLL',
      ],
    ],
    'Facebook' => [
      'enabled' => true,
      'keys' => [
        'id' => '246492156751142',
        'secret' => '156c48fe4931bf357f2b6d8d498bf4a0',
      ],
    ],
  ],
];
