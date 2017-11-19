<?php

namespace Geeklearners\Modalbox;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;
use Geeklearners\Modalbox\Modal;
class ModalServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        include __DIR__.'/Route.php';
        $this->loadViewsFrom(__DIR__.'/view','modal');
        $this->registerBladeDirectives();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->singleton(Modal::class,function($app){
            return new Modal;
        });
    }

    public function registerBladeDirectives(){
        Log::info("Now creating custom");
        Blade::directive('modalButton',function($arg){
            list($type,$class,$id,$value)=$this->getArgs($arg);
            $stat="";
            if($type=="button"){
                $stat.="<button type='button'";
            }else{
                $stat.="<span";
            }
            $stat.=" class=$class";
            if($type=="button"){
                $stat.=" data-toggle='modal' data-target='$id'>$value</button>";
            }else{
                $stat.="  data-toggle='modal' data-target='$id'>$value</span>";
            }
            return "<?php echo \"$stat\" ?>";
        });

        Blade::directive("modalBox",function($args){
            list($heading,$id,$path,$data)=$this->getArgs($args);
            $a=View::make('modal::dialog',['heading'=>$heading,'id'=>$id,'path'=>$path,'data'=>$data])->render();
            return "<?php echo '$a' ?>";
        });
    }

    public function getArgs($args){
        return explode(',',str_replace(['(',')'],'',$args));
    }
}
