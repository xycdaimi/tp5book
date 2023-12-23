<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:70:"A:\wamp64\www\phptp5\public/../application/admin\view\admin\users.html";i:1703326879;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>用户管理</title>
    <link rel="stylesheet" href="/static/css/users.css">
    <link rel="stylesheet" href="/static/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/static/bootstrap/css/bootstrap-icons.css">
    <link rel="stylesheet" href="/static/css/pagination.css">
    <link rel="shortcut icon" href="/static/img/favicon.ico" type="image/x-icon">
</head>
<body>
    <div class="app">
        <div class="user">
            <div class="operate-pane">
                <div class="row">
                    <div class="col-lg-2">
                        <button class="btn btn-success" data-toggle="modal" data-target="#add-user-modal"><i class="bi bi-plus-lg"></i>添加用户</button>
                    </div>
                    <div class="col-lg-8">
                        <form method="get" id="search-form" action="searchUsers">
                            <div class="search">
                                <select name="search-type" id="search-type" class="form-control">
                                    <option value="username">用户名</option>
                                    <option value="name">名字</option>
                                    <option value="id-card">借书卡号</option>
                                    <option value="phone">手机号</option>
                                </select>
                                <input type="text" class="form-control" id="search-text" name="search-text">
                                <button type="submit" class="btn btn-primary btn-search">搜索</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-2">

                    </div>
                </div>
            </div>

            <div class="user-pane">
                <div id="user-table">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                            <th>Id</th>
                            <th>用户名</th>
                            <th>名字</th>
                            <th>性别</th>
                            <th>借书卡号</th>
                            <th>手机号</th>
                            <th>身份</th>
                            <th>可借阅书本数量</th>
                            <th>操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$table): $mod = ($i % 2 );++$i;?>
                            <tr>
                            <th><?php echo $table['Id']; ?></th>
                            <td><?php echo $table['username']; ?></td>
                            <td class="name"><?php echo $table['name']; ?></td>
                            <td><?php echo $table['gender']; ?></td>
                            <td><?php echo $table['id_card']; ?></td>
                            <td><?php echo $table['phone']; ?></td>
                            <td><?php echo $table['identity']; ?></td>
                            <td><?php echo $table['book_count']; ?></td>
                            <td>
                                <button class="btn btn-primary btn-edit" data-toggle="modal" data-target="#edit-user-modal" name="<?php echo $table['Id']; ?>"><i class="bi bi-pencil-square"></i>编辑</button>
                                <button class="btn btn-danger btn-delete" data-toggle="modal" data-target="#delete-user-modal" name="<?php echo $table['Id']; ?>"><i class="bi bi-trash"></i>删除</button>
                            </td>
                            </tr>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        <!-- 样板 -->
                        <!-- <tr>
                            <th>1</th>
                            <td>admin</td>
                            <td>男</td>
                            <td>10000000</td>
                            <td>10000000000</td>
                            <td>管理员</td>
                            <td>999</td>
                            <td>
                                <button class="btn btn-primary btn-edit">编辑</button>
                                <button class="btn btn-danger btn-delete">删除</button>
                            </td>
                            </tr> -->
                        </tbody>
                    </table>
                </div>

                <div class="page-box">
                    <div class="m-style pag-box"><?php echo $data->render(); ?></div>
                </div>
            </div>
        </div>

        <!-- 添加用户模态框 -->
        <div class="modal fade" id="add-user-modal" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">添加用户</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="add-user-form">
                        <div class="form-item">
                            <label for="username"><span class="must">*</span>用户名</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="用户名">
                        </div>
                        <div class="form-item">
                            <label for="password"><span class="must">*</span>密码</label>
                            <input type="text" name="password" id="password" class="form-control" placeholder="密码">
                        </div>
                        <div class="form-item">
                            <label for="name"><span class="must">*</span>名字</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="名字">
                        </div>
                        <div class="form-item">
                            <label for="gender"><span class="must">*</span>性别</label>
                            <select name="gender" id="gender" class="form-control">
                                <option value="">请选择性别</option>
                                <option value="男">男</option>
                                <option value="女">女</option>
                            </select>
                        </div>
                        <div class="form-item">
                            <label for="id-card"><span class="must">*</span>借书卡号</label>
                            <input type="text" name="id-card" id="id-card" class="form-control" placeholder="借书卡号">
                        </div>
                        <div class="form-item">
                            <label for="phone"><span class="must">*</span>手机号</label>
                            <input type="text" name="phone" id="phone" class="form-control" placeholder="手机号">
                        </div>
                        <div class="form-item">
                            <label for="identity"><span class="must">*</span>身份</label>
                            <select name="identity" id="identity" class="form-control">
                                <option value="">请选用户身份</option>
                                <option value="teacher">老师</option>
                                <option value="student">学生</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
                    <button type="button" class="btn btn-success add-user-button">添加</button>
                </div>
                </div>
            </div>
        </div>

        <!-- 编辑用户模态框 -->
        <div class="modal fade" id="edit-user-modal" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">编辑用户</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="edit-user-form">
                        <div class="form-item">
                            <label for="edit-username"><span class="must">*</span>用户名</label>
                            <input type="text" name="edit-username" id="edit-username" class="form-control" placeholder="用户名">
                        </div>
                        <div class="form-item">
                            <label for="edit-password"><span class="must">*</span>密码</label>
                            <input type="text" name="edit-password" id="edit-password" class="form-control" placeholder="密码">
                        </div>
                        <div class="form-item">
                            <label for="edit-name">名字</label>
                            <input type="text" name="edit-name" id="edit-name" class="form-control" placeholder="名字">
                        </div>
                        <div class="form-item">
                            <label for="edit-gender">性别</label>
                            <select name="edit-gender" id="edit-gender" class="form-control">
                                <option value="">请选择性别</option>
                                <option value="男">男</option>
                                <option value="女">女</option>
                            </select>
                        </div>
                        <div class="form-item">
                            <label for="edit-id-card">借书卡号</label>
                            <input type="text" name="edit-id-card" id="edit-id-card" class="form-control" placeholder="借书卡号">
                        </div>
                        <div class="form-item">
                            <label for="edit-phone">手机号</label>
                            <input type="text" name="edit-phone" id="edit-phone" class="form-control" placeholder="手机号">
                        </div>
                        <div class="form-item">
                            <label for="edit-identity">身份</label>
                            <select name="edit-identity" id="edit-identity" class="form-control">
                                <option value="">请选用户身份</option>
                                <option value="teacher">老师</option>
                                <option value="student">学生</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
                    <button type="button" class="btn btn-primary edit-user-button">编辑</button>
                </div>
                </div>
            </div>
        </div>

        <!-- 删除用户模态框 -->
        <div class="modal fade" id="delete-user-modal" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">删除用户</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>确定删除 <span id="delete-name"></span> 此用户吗？</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger delete-user-button">删除</button>
                </div>
                </div>
            </div>
        </div>
    </div>
    <script src="/static/js/jquery.min.js"></script>
    <script src="/static/js/popper.min.js"></script>
    <script src="/static/bootstrap/js/bootstrap.min.js"></script>
    <script src="/static/js/users.js"></script>
</body>
</html>