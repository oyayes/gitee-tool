<?php
/**
 * PhpStorm.
 * User: Jay
 * Date: 2020/5/24
 */

namespace BaseBundle\Command;

use Gitee\Project;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

class GiteeAllProjectBackCommand extends Command
{
    public static $user_name;

    public static $password;

    public static $client_id;

    public static $client_secret;

    public static $path;

    public function configure()
    {
        $this->setName('gitee:project:all:back')
            ->setDescription('gitee 全部项目备份');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $helper = $this->getHelper('question');

        do {
            $question = new Question('gitee登陆账号:');
             self::$user_name = $helper->ask($input, $output, $question);
        } while (empty(self::$user_name));

        do {
            $question = new Question('gitee登陆密码:');
            $question->setHidden(true);
            self::$password = $helper->ask($input, $output, $question);
        } while (empty(self::$password));

        do {
            $question = new Question('gitee个人应用id:');
            self::$client_id = $helper->ask($input, $output, $question);
        } while (empty(self::$client_id));

        do {
            $question = new Question('gitee个人应用secret:');
            self::$client_secret = $helper->ask($input, $output, $question);
        } while (empty(self::$client_secret));

        do {
            $question = new Question('备份存放目录:');
            self::$path = $helper->ask($input, $output, $question);
        } while (empty(self::$path));

        $return_var = null;
        $output_ex = null;
        exec('cd ' . self::$path , $output_ex, $return_var);

        if($return_var != 0){
            exit;
        }

        $output->writeln('备份目录' . self::$path);

        $count = $this->projectsBack($input, $output, new Project());

        $output->writeln('共备份' . $count . '个项目');
    }

    private function projectsBack(InputInterface $input, OutputInterface $output, Project $projectClass, $page = 1, $count = 0)
    {
        $projects = $projectClass->allProject($page, 100);

        if(empty($projects)){
            return $count;
        }else{
            foreach ($projects as $project){
                $count ++;
                $output->writeln('备份项目' . $project['full_name'] . $project['description']);
                exec('cd '. self::$path .'; git clone ' . $project['ssh_url']);
            }

            return $this->projectsBack($input, $output, $projectClass, $page + 1, $count);
        }
    }
}