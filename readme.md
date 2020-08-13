
### 介绍
视频直播项目前端界面 部分代码 

### 技术栈
vue +vuex+node+webpack

### 项目运行


```
//安装node模块
$ npm i

// dev开发模式 webpack --config build/webpack.dev.conf.js -w
// prod产品模式 webpack --config build/webpack.prod.conf.js -w
$ npm dev

```

### 项目布局 前端

```
.
├── views                             前端目录
│   ├── admin                         管理员后台界面
│   ├── errors                        错误页面
│   ├── front                         v1+v2前端版本 主要使用php模板实现
│   ├── frontv3                       v3版本的前端
│       ├── build                      webpack构建配置
│       ├── config                     配置文件
│       ├── pc                         pc网站
             ├──...
│       ├── phone                      webapp
│           ├── router                 路由
|           ├── App.vue                vue组件的根目录
|           ├── index.blade.php        入口主页
|           ├── main.js                入口文件
|           ├── room.blade.php         打包编译后的主页
| 
│       ├── src                       
|           ├── mixins                 pc和phone公共的vuejs部分  
|           ├── mobile_page            phone组件页面主页
|           ├── mobile_views           phone组件文件夹
|           ├── pc_page                pc组件页面主页
│           ├── pc_views               pc组件文件夹
│           ├── store                  vuex文件夹
|               ├── action.js           action操作  
|               ├── dms_reconnect.js    dms连接
|               ├── dms_reg.js          dms消息
|               ├── getter.js           vuex getter
│               ├── mutations.js        vuex mutations
│               ├── store.js            vue存放的state 
│               ├── types.js            一些操作变量名跟初始化
│
│           ├── vue-layer.js  
│      
│   ├── super                        超管后台管理页面
│   ├── widget                       jsrender模板






```
