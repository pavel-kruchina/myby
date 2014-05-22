<?php

class AddController extends Controller
{
    protected $landingTexts= array(
        'default'   => array('welcomeText'   => 'Что Вы хотите купить?', 
                        'titleExample'  => 'Например: Кондиционер до 4000 грн',
                        'textExample'   => 'Например: Кондиционер зима/лето в комнату на 20 квадратов. Желательно с установкой.'),
        
        'tv'        => array('welcomeText'   => 'Какой телевизор Вы хотите купить?', 
                        'titleExample'  => 'Например: Телевизор до 8000 грн.',
                        'textExample'   => 'Например: Samsung UE40F6400 или другая модель с диагональю 40 дюймов, SMART и 3D до 8000 грн + настенное крепление и hdmi кабель на 3 метра.'),
        
        'refrigerator'=>array('welcomeText'  => 'Какой холодильник Вы хотите купить?', 
                        'titleExample'  => 'Например: Холодильник до 7000 грн.',
                        'textExample'   => 'Например: Нужен двухкамерный бежевый холодильник с No Frost и нижней морозильной камерой. Высота до 200 см, ширина до 60. Подъем на 8 этаж'),
        
        'conditioner'=>array('welcomeText'   => 'Какой кондиционер Вы хотите купить?', 
                        'titleExample'  => 'Например: Кондиционер до 5000 грн.',
                        'textExample'   => 'Например: Кондиционер зима/лето в комнату на 20 квадратов. Желательно с установкой'),
        
        'wash'      => array('welcomeText'   => 'Какую стиральную машину Вы хотите купить?', 
                        'titleExample'  => 'Например: Стиральная машинка до 5000 грн.',
                        'textExample'   => 'Например: Нужна машинка белого цвета с глубиной до 45 сантиметров, желательно с подключением.'),
        
        'dishwash'  => array('welcomeText'   => 'Какую посудомоечную машину Вы хотите купить?', 
                        'titleExample'  => 'Например: Посудомоечная машинка до 5000 грн.',
                        'textExample'   => 'Например: Нужна встраиваемая посудомойка с фасадом из нержавейки, ширина 60 сантиметров, желательно с подключением.'),
        
        'phone'     => array('welcomeText'   => 'Какой телефон Вы хотите купить?', 
                        'titleExample'  => 'Например: Телефон до 2500 грн.',
                        'textExample'   => 'Например: Sony Xperia M в черном цвете и карта microSD на 32 Gb.'),
        
        'tab'       => array('welcomeText'   => 'Какой планшет Вы хотите купить?', 
                        'titleExample'  => 'Например: Планшет до 4000 грн.',
                        'textExample'   => 'Например: Нужен планшет белого цвета на 8 дюймов для девушки, с картой на 32 Gb и чехлом. Что посоветуете?'),
        
        'photo'     => array('welcomeText'   => 'Какой фотоаппарат Вы хотите купить?', 
                        'titleExample'  => 'Например: Зеркальный фотоаппарат до 8000 грн.',
                        'textExample'   => 'Например: Nikon или Canon со сменным объективом и качественным видео, картой на 64 GB и чехлом'),
        
        'multivarka'=> array('welcomeText'   => 'Какую мультиварку Вы хотите купить?', 
                        'titleExample'  => 'Например: Мультиварка до 1500 грн.',
                        'textExample'   => 'Например: Нужна компактная мультиврака, чтобы можно было готовить молочные каши. Что посоветуете?'),
        
        'microwave' => array('welcomeText'   => 'Какую микроволновую печь Вы хотите купить?', 
                        'titleExample'  => 'Например: Микроволновка до 800 грн.',
                        'textExample'   => 'Например: Нужна простая и надежная печь с механическим управлением. Что посоветуете?'),
        
        'notebook'  => array('welcomeText'   => 'Какой ноутбук Вы хотите купить?', 
                        'titleExample'  => 'Например: Ноутбук до 8000 грн.',
                        'textExample'   => 'Например: Lenovo G500 или аналог на Core i5 с графикой не ниже 8570/GT720 + простая беспроводная мышь Logitech'),
    );
    
    public function filters()
    {
        return array(
            'accessControl',
        );
    }
    
    public function accessRules()
    {
        return array(
            array('allow',
                'actions'=>array('index'),
                'users'=>array('*'),
            ),
            
            array('deny',
                'users'=>array('*'),
            ),
        );
    }
    
    public function actionIndex()
	{   
        $landing = $this->getLanding();
        $regform = new \models\forms\UserRegistrationForm();
        $loginForm =  new \models\forms\UserLogin();
        $form = new models\forms\AddProject();
        if (actionControllers\saveProject::ifFormSend($form))
            Yii::app()->request->redirect('/public/mylist/?add_project=1');
        
        $randomProject = Project::getRandom();
        $this->render('add', array('regform'=>$regform, 'add'=>$form, 'randomProject'=>$randomProject, 'loginForm'=>$loginForm, 'landing'=>$landing));
	}
    
    protected function getLanding() {
        $landing = isset($_GET['landing']) ? $_GET['landing'] : 'default';
        if (!isset($this->landingTexts[$landing]))
            $landing = 'default';
        
        return $this->landingTexts[$landing];
    }
    
}