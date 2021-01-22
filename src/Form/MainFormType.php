<?php

namespace App\Form;

use App\Entity\FormData;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MainFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('siteName', TextType::class, ['label'=>"Nombre del Sitio (incluir dominio)"])
            ->add('alias', TextType::class, ['label'=>"Alias", 'required'=>false])

            ->add('ldapName', TextType::class, ['label'=>"Nombre"])
            ->add('ldapLastName', TextType::class, ['label'=>"Apellidos"])
            ->add('ldapEmail', TextType::class, ['label'=>"Correo"])
            ->add('ldapPhone', TextType::class, ['label'=>"Teléfono"])
            ->add('ldapPassword', PasswordType::class, ['label'=>"Contraseña"])

            ->add('client_type', ChoiceType::class, 
            ['label'=>"Cliente",
            'choices' =>[
                'Natural' => "Natural",
                'Empresarial' => "Empresarial"
            ]])

            ->add('diskSpace', ChoiceType::class, 
            ['label'=>"Espacio en disco",
            'choices' =>[
                '800MB' => 800,
                '2.4GB' => 2400,
                '4.0GB' => 4000,
                '8.0GB' => 8000
            ]])
            ->add('extraDiskSpace', IntegerType::class, 
            ['label'=>"Espacio Adicional disco", 'attr'=> ['step'=>100, 'min'=>0],
             'data'=> 0])
            ->add('dbSpace', ChoiceType::class, 
            ['label'=>"Espacio en bd",
            'choices' =>[
                '200MB' => 200,
                '600MB' => 600,
                '1.0GB' => 1000,
                '2.0GB' => 2000
            ]])
            ->add('extraDBSpace', IntegerType::class, 
            ['label'=>"Espacio Adicional BD", 'attr'=> ['step'=>100, 'min'=>0],
             'data'=> 0])

            ->add('packetName', TextType::class, ['label'=>"Paquete Contratado", 'required'=>false])
            
            ->add('webServer', ChoiceType::class, 
            ['label'=>"Servidor Web",
            'choices' =>[
                'Apache/PHP/Node.js' => 1,
                'Apache Tomcat' => 2
            ]])
            ->add('phpVersion', ChoiceType::class, 
            ['label'=>"Version php",
            'choices' =>[
                '5.6' => "5.6",
                '7.2' => "7.2",
                '7.3' => "7.3",
                '7.4' => "7.4"
            ], 'required'=>'false'])

            ->add('node', CheckboxType::class, ['label'=> "NodeJS", 'required'=>false])

            ->add('dbServer', ChoiceType::class, 
            ['label'=>"Servidor de Base de Datos",
            'choices' =>[
                '' => "",
                'MySQL' => 1,
                'PostgreSQL' => 2
            ]])
            ->add('dbPassword', PasswordType::class, ['label'=>"Contraseña"])

            ->add('webTech', ChoiceType::class, 
            ['label'=>"Plantilla",
            'choices' =>[
                'symfony' => "symfony",
                'Desarrollo Autónomo' => "nuevo"    
            ]])
            ->add('webTechVersion', TextType::class, ['label'=>"Versión"])

            ->add('protctedFiles', TextareaType::class, ['label'=>'Ficheros protegidos', 'required'=>false])
            ->add('indexName', TextType::class, ['label'=>"Fichero de inicio"])

            ->add('save', SubmitType::class, ['label'=>"Guardar"])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => FormData::class,
        ]);
    }
}
