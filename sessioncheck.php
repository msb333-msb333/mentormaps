<?php
//starts the php session if it isn't already
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}