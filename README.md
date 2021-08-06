# php开发工具箱
> 当前包会持续更新，增加新的功能和方法

当前包还没有发布，可在本地进行安装，安装后更新或修改这个包即可使用新功能，无需进行composer update

### 安装方法
1. 将当前包 clone 到项目同级目录中

2. 在package.json文件中添加
```
"repositories": {
    "hug-code/php-units": {
        "type": "path",
        "url": "../php-units",
        "options": {
            "symlink": true
        }
    }
},
```
3. 执行安装命令
```
composer require hug-code/php-units @dev
```
