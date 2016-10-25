<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Registration
 *
 * @author sharif rahman
 */
class Registration {

    var $hostName = "localhost";
    var $user = "root";
    var $dbmsPassword = "";
    var $dbName = "programming_shikhi";

    function getConnetion($hostName, $user, $dbmsPassword, $dbName) {
        $connection = mysqli_connect($hostName, $user, $dbmsPassword, $dbName) or die("Could not connect with the database");
        return $connection;
    }

}
