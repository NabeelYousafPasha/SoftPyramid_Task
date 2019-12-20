<?php


/*
| --------------------------------
| -------- General Application Settings ------
| --------------------------------
*/
// -----------------------------
function loggedInUser()
{
    if (auth()->user())
        return auth()->user();
    return null;
}

// -----------------------------
function loggedInUserRole()
{
    if (!loggedInUser()){
        return false;
    }else{
        if (loggedInUser()->hasRole('admin'))
            return Spatie\Permission\Models\Role::findByName('admin') ?? false;
        if (loggedInUser()->hasRole('user'))
            return Spatie\Permission\Models\Role::findByName('user') ?? false;
    }
}
