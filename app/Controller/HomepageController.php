<?php

class HomepageController extends AppController {

    // LANDING PAGE
    public function index() {
        if ($this->Auth->user()) {
            $this->redirect(['controller' => 'users', 'action' => 'index']); // Redirect to the dashboard if logged in.
        }
    }

}

?>