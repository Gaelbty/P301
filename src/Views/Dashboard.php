<?php

namespace Views;


class Dashboard
{
    public function __construct(private string $username) {}

    public function show(): void
    {
        begin_page($this->username . '\'s dashboard', '/css/dashboard.css');
        ?>
        <h1>Hello, <?=$this->username?> !</h1>
    <?php }
}