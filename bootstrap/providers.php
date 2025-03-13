<?php

return [
    App\Providers\AppServiceProvider::class,
    App\Providers\BroadcastServiceProvider::class, //Laravel10 之前 在 config\app.php文件中 默认是注释的，Laravel10 之后 在 bootstrap\providers.php文件中
];
