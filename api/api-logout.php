<?php

session_start(); 
session_destroy(); 

echo '{
    "status": 1 ,
    "message": "user was logged out"
}';

