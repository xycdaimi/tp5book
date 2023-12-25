<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:69:"A:\wamp64\www\phptp5\public/../application/users\view\users\home.html";i:1703477794;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>主页</title>
    <link rel="stylesheet" href="/static/css/home.css">
    <link rel="stylesheet" href="/static/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/static/bootstrap/css/bootstrap-icons.css">
    <link rel="stylesheet" href="/static/css/pagination.css">
    <link rel="shortcut icon" href="/static/img/favicon.ico" type="image/x-icon">
</head>
<body>
    <div class="app">
        <div class="home">
            <div class="container-fluid info-board">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="book">
                            <i class="bi bi-book"></i>
                            <div class="text">
                                <p class="title">图书馆书本数量</p>
                                <p class="subtitle"><?php echo $book; ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="overtime">
                            <i class="bi bi-clipboard-x"></i>
                            <div class="text">
                                <p class="title">超时未归还书本数量</p>
                                <p class="subtitle"><?php echo $over; ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="borrow">
                            <i class="bi bi-clipboard-data"></i>
                            <div class="text">
                                <p class="title">剩余可借书本数量</p>
                                <p class="subtitle"><?php echo $borrow; ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="time">
                            <i class="bi bi-clock"></i>
                            <div class="text">
                                <p class="title">系统时间</p>
                                <p class="subtitle">0</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="log">
                <div class="card">
                    <div class="card-header">借阅的书籍</div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ISBN</th>
                                    <th>书名</th>
                                    <th>类别</th>
                                    <th>作者</th>
                                    <th>借阅时间</th>
                                    <th>截止时间</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$table): $mod = ($i % 2 );++$i;?>
                                <tr>
                                    <td><?php echo $table['isbn']; ?></td>
                                    <td><?php echo $table['name']; ?></td>
                                    <td><?php echo $table['groups']; ?></td>
                                    <td><?php echo $table['author']; ?></td>
                                    <td><?php echo $table['time']; ?></td>
                                    <td><?php echo $table['r_time']; ?></td>
                                </tr>
                                <?php endforeach; endif; else: echo "" ;endif; ?>
                            </tbody>
                        </table>
                    </div>
                    
                </div>
            </div>

            
            <div class="page-box">
                <div class="m-style pag-box">
                </div>
            </div>
        </div>
        
    </div>
    <script src="/static/js/canvas-nest.min.js"></script>
    <script src="/static/js/jquery.min.js"></script>
    <script src="/static/js/popper.min.js"></script>
    <script src="/static/bootstrap/js/bootstrap.min.js"></script>
    <script src="/static/js/home.js"></script>
</body>
</html>