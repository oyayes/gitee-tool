# gitee 工具集

## 运行环境

  symfony2.8 php5.6
  
  安装git和对应的ssh公钥
 
## 文件权限目录 --读写权限

   chmod -R 777 app/cache app/logs  
   
## 创建应用 

   [应用创建教程](https://gitee.com/api/v5/oauth_doc#/list-item-3)
    
## 命令集合 （执行命令用已配置好ssh公钥用户执行）
    
   全部仓库备份命令
    
   php app/console gitee:project:all:back 
   
## 执行过程简述
   
   该工具根据gitee官方开发接口开发；使用官方文档需要获得授权；
   
   所以使用本工具集内的命令需要填入授权的参数，参数的具体输入在执行命令后会有对应提示，按照提示输入即可；
   
   授权参数可以查看上文创建应用给出的链接，简尔言之，需要gitee的登陆账密码和对应账号的应用'client_id'和'client_secret';
   
   应用的创建点击上文的创建应用教程链接，进入页面后在侧边栏中找到'创建应用流程'按照说明写入即可。
   
 
   

 
  




