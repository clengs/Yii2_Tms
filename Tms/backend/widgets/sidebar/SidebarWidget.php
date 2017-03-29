<?php
namespace backend\widgets\sidebar;

/**
 * 后台siderbar插件
 */
use Yii;
use yii\base\Widget;
use yii\widgets\Menu;
use yii\helpers\Html;
use yii\db\ActiveRecord;

class SidebarWidget extends Menu
{    
    public $submenuTemplate = "\n<ul class=\"children\">\n{items}\n</ul>\n";
    
    public $options = ['class'=>'nav nav-pills nav-stacked nav-quirk'];
    
    public $activateParents = true;
    
    //public $title = Yii::t('common', 'indexMenu');

    public function init()
    {
        $this->items = [
            ['label' =>'<i class="fa fa-dashboard"></i><span>'.Yii::t('common', 'indexMenu').'</span>','url'=>['site/index']],
            ['label' =>'<a href=""><i class="fa fa-th-list"></i><span>系统管理</span></a>','options'=>['class'=>'nav-parent'],'items'=>[
                    ['label'=>'员工管理','url'=>['admin/index'],
                        'items'=>[
                            ['label'=>'新增员工','url'=>['admin/create'],'visible'=>true],
                        ]                       
                    ],

                    ['label' =>'部门管理','url' =>['department/index']],
                ]
            ],

            //开户管理
            ['label' =>'<a href=""><i class="fa fa-th-list"></i><span>开户管理</span></a>',
                'options'=>['class'=>'nav-parent'],
                'items'=>[
                    ['label'=>'现存用户','url'=>['open-account/index']],
                    ['label'=>'新开账户','url'=>['open-account/create']],
                ]
            ],

            //经销商管理
            ['label' =>'<a href=""><i class="fa fa-th-list"></i><span>经销商管理</span></a>',
                'options'=>['class'=>'nav-parent'],
                'items'=>[
                    ['label'=>'经销商信息','url'=>['supplier/index']],
                ]
            ],

            //设备管理
            ['label' =>'<a href=""><i class="fa fa-th-list"></i><span>终端管理</span></a>',
                'options'=>['class'=>'nav-parent'],
                'items'=>[
                    ['label'=>'库存','url'=>['terminal/index']],
                    ['label'=>'终端入库','url'=>['terminal/create']],
                    ['label'=>'批量导入','url'=>['terminal/batchimport']],
                    ['label'=>'终端出库','url'=>['outbound/index']],
                    ['label'=>'终端回收', 'url'=>['#']],
                ]
            ],
            
            

            //仓库管理
            ['label' => '<a href=""><i class="fa fa-th-list"></i><span>仓库管理</span></a>',
                'options' => ['class' => 'nav-parent'],
                'items' => [
                    ['label' => '仓库信息', 'url' => ['storehouse/index']],
                ],
            ],

            //消息管理
            ['label' => '<a href=""><i class="fa fa-th-list"></i><span>消息管理</span></a>',
                'options' => ['class' => 'nav-parent'],
                'items' => [
                    ['label' => '信箱', 'url' => ['auditing/index', 'id'=> Yii::$app->user->identity->id]],
                    ['label' => '申请', 'url' => ['application/application']],
                ],
            ],
        ];
    }

        /**
     * Normalizes the [[items]] property to remove invisible items and activate certain items.
     * @param array $items the items to be normalized.
     * @param boolean $active whether there is an active child menu item.
     * @return array the normalized menu items
     */
    protected function normalizeItems($items, &$active)
    {
        foreach ($items as $i => $item) {
            if (!isset($item['label'])) {
                $item['label'] = '';
            }
            $encodeLabel = isset($item['encode']) ? $item['encode'] : $this->encodeLabels;
            $items[$i]['label'] = $encodeLabel ? Html::encode($item['label']) : $item['label'];
            $hasActiveChild = false;
            if (isset($item['items'])) {
                $items[$i]['items'] = $this->normalizeItems($item['items'], $hasActiveChild);
                if (empty($items[$i]['items']) && $this->hideEmptyItems) {
                    unset($items[$i]['items']);
                    if (!isset($item['url'])) {
                        unset($items[$i]);
                        continue;
                    }
                }
            }
            if (!isset($item['active'])) {
                if ($this->activateParents && $hasActiveChild || $this->activateItems && $this->isItemActive($item)) {
                    $active = $items[$i]['active'] = true;
                } else {
                    $items[$i]['active'] = false;
                }
            } elseif ($item['active']) {
                $active = true;
            }
             
            if (isset($item['visible']) && !$item['visible']) {
                unset($items[$i]);
                continue;
            }
        }
    
        return array_values($items);
    }
}