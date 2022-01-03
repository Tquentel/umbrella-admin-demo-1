<?php

namespace App\Menu;

use Symfony\Component\Security\Core\Security;
use Twig\Environment;
use Umbrella\AdminBundle\Menu\BaseAdminMenu;
use Umbrella\AdminBundle\UmbrellaAdminConfiguration;
use Umbrella\CoreBundle\Menu\Builder\MenuBuilder;

class AdminMenu extends BaseAdminMenu
{
    private Security $security;

    /**
     * AdminMenu constructor.
     */
    public function __construct(Security $security, Environment $twig, UmbrellaAdminConfiguration $configuration)
    {
        $this->security = $security;
        parent::__construct($twig, $configuration);
    }

    public function buildMenu(MenuBuilder $builder, array $options)
    {
        $r = $builder->root();

        $r->add('about')
            ->icon('uil-home')
            ->route('app_admin_default_about');

        $r->add('components');

        $r->add('datatable')
            ->icon('uil-table')
            ->add('basic')
                ->route('app_admin_datatablebasic_index')
                ->end()
            ->add('custom_adapter')
                ->route('app_admin_datatablecustomadapter_index')
                ->end()
            ->add('editable')
                ->route('app_admin_datatableeditable_index')
                ->end()
            ->add('selectable')
                ->label('Selectable / Bulk edition')
                ->route('app_admin_datatableselectable_index')
                ->end()
            ->add('exportable')
                ->route('app_admin_datatableexportable_index')
                ->end()
            ->add('multiple')
                ->route('app_admin_datatablemultiple_index')
                ->end()
            ->add('modal')
                ->route('app_admin_datatablemodal_index')
                ->end()
            ->add('tree')
                ->route('app_admin_datatabletree_index')
                ->end();

        $r->add('form')
            ->icon('uil-document-layout-center')
            ->add('theme')
                ->route('app_admin_form_theme')
                ->end()
            ->add('common')
                ->route('app_admin_form_common')
                ->end()
            ->add('advanced_select')
                ->route('app_admin_form_select');

        $r->add('js_response')
            ->icon('uil-exchange')
            ->route('app_admin_js_index');
        $r->add('menu')
            ->icon('uil-bars')
            ->route('app_admin_menu_index');
        $r->add('notification')
            ->icon('uil-bell')
            ->route('app_admin_notification_index');
        $r->add('config_reference')
            ->icon('uil-cog')
            ->route('app_admin_umbrellaconfig_index');

        $r->add('pages');

        $r->add('login')
            ->route('umbrella_admin_login')
            ->icon('uil-layers');
        $r->add('reset password')
            ->route('umbrella_admin_security_passwordrequest')
            ->icon('uil-layers');

        if ($this->security->getUser()) {
            $r->add('my account')
                ->route('umbrella_admin_profile_index')
                ->icon('uil-layers');
        }

        $r->add('crud');

        $r->add('users')
            ->icon('uil uil-user')
            ->route('umbrella_admin_user_index');
    }
}
