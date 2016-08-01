<?php
/**
 * PasswordController.php
 */
namespace App\Http\Controllers;

use App\ResetsPasswords;

/**
 * Controller that uses the ResetsPasswords trait
 */
class PasswordController extends Controller
{
    use ResetsPasswords;
    /**
     * PasswordController constructor
     */
    public function __construct()
    {
        //Assigns broker to be the users array in the 'passwords' value in config\auth.php
        $this->broker = 'users';
    }
}