<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('products')->delete();
        
        \DB::table('products')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name_en' => '999 CAMISOLE',
                'name_zh' => '999 细带',
                'short_desc_en' => '999 CAMISOLE',
                'short_desc_zh' => '999 细带',
                'desc_en' => '<p>888 VEST</p><p>COLOUR : BEIGE , BLACK</p><p>SIZE : S, M, L, XL, XXL</p><p>PACKING : BOXED</p><p>&nbsp;</p><p>1. New upgrade of any cut fabric, soft and delicate cotton touch, comfortable and close-fitting, non feeling high elasticity, gentle care, meeting the needs of any period. The honeycomb wet guide in the front is visible when it meets water, so you will get healthy.</p><p>2. Ultra soft padding with upgraded elasticity, cotton soft touch, honeycomb vents, and cooling.Stuffy, the "U"-shaped far-infrared rays in the cup promote blood circulation, and the negative ions in the cup enhance body functions and improve sub-health. The coaster has a micro-elastic design in the center position, which is more stable to gather, and does not move or expand.</p><p>3. With widened hollow design, highlights the three-dimensional effect, stabilizes the chest shape and prevent slide up, and makes the body move free.</p><p>4. All-round mesh glue integrated molding&nbsp; black technology, neat and beautiful, enhanced expansion and contraction, no steel ring zero pressure, comfortable and breathable, perfect fit, heighten the side bones, gather the auxiliary breast, and show a perfect posture.</p><p>5. No sensation label, zero sensation.</p><p>&nbsp;</p><figure class="image"><img src="https://lh4.googleusercontent.com/cA4F2RbcQ9zy_tIO-Hw-ohUf5UbC4X7peiThUTpEN275Ijl5eaJHKVIiAxRzZfxdw_S9IXnMAtwgM6Cfemo2Rrt78kA0Tm46zt9YyKEt92HlvRk34mVJ5rCIloL8vxCeBt1CiYtO"></figure><figure class="image"><img src="https://lh6.googleusercontent.com/WOk8Fner6VE2DqvJTkOHs04a7xhHlfHXHoBEHhqA9JfHHk88raItsePCQt8ons_iYDl1uig5_VBOOqpbAaOVft12t10UEozb2lgWNZRqlRzdbF0M4w05aorN6mChw401okSDbUi4"></figure><figure class="image"><img src="https://lh5.googleusercontent.com/3FvzFxJj5ARcMyimsiRS6k8VfAn9yu8vKXbFdpCzMPF7NP9Yviqu4T3AqoFEiAECAEogo8hepxS-iLo0yVWeMs9hu3OEIZ5FEiONOXFSA9N8C3-S8R0Q92gU-JlW2WaCsB-sbD8_"></figure>',
                'desc_zh' => '<p>888背心款</p><p>颜色：肤色，黑色</p><p>码数：S，M，L，XL，XXL</p><p>包装：盒装</p><p>&nbsp;</p><p>&nbsp;</p><p>1、任意裁面料新升级，触感棉柔细腻，舒适贴身，无感高弹，温柔呵护，满足任何时期需求。前里蜂窝导湿格，遇水则显，随时掌握身体健康。</p><p>2、超Q乳罩杯，弹力升级，触感棉柔，蜂窝透气孔，排出热量不气。杯里“U”字型远红外线，促进血液循环，杯里负离子，增强身体机能，改善亚健康。杯垫心位微弹连带设计，更稳定聚拢，不游移不外扩。</p><p>3、三明治夹层，加宽镂空设计，凸显立体感，稳固胸型不上滑，身体活动更自如。</p><p>4、全方位网孔胶一体成型黑科技工艺，整洁美观，增强伸缩力度无钢圈零压力，舒适透气，完美贴身，加高侧骨位，收拢副乳，展现完美身姿。</p><p>5、无感标签，肌肤零感无刺激。</p><p>&nbsp;</p><figure class="image"><img src="https://lh5.googleusercontent.com/FIphLVufRVhp8JF5kImzRSnfz5Kg7pyCKizTb3efVDC3MTEZqLKVxByIxfQa2TcNOxpkunLDmXIY6i9GkMOIJZHmu-CKs6Y_E3kumlHYtGvUg4SQmyN_wfaJVJkV4v5bS0gO2k2A"></figure><figure class="image"><img src="https://lh5.googleusercontent.com/9pRZerPqS1z7CpBcu5PkhpOA7fOtpHvfn6em3DusQgL0ftfCK-bSL6XK4RCUQbLGApiY5jq2w8_mWNweo7JYt1TfVxGT_KBV9sm0OcNCPEzfTyeozXZPI2LbEEvnJn_-Xl_BoWop"></figure><figure class="image"><img src="https://lh5.googleusercontent.com/0TO27dmBdm2XZKVty1XYQ760FQ7CQ522IKbFXZZK3YCDT_sBwQ85twCC6hNYOMuCBiYc8REX-miX3fXi-J0sFCDryHH0-gKW2ZI3YSI8GKo3-MhA97w5ocvHZuil3ogicu08Uy0K"></figure>',
                'status' => '1',
                'created_at' => '2021-08-18 15:07:58',
                'updated_at' => '2021-09-09 17:51:31',
                'deleted_at' => NULL,
                'category_id' => 1,
            ),
            1 => 
            array (
                'id' => 2,
                'name_en' => '888 VEST',
                'name_zh' => '888 粗带',
                'short_desc_en' => '888 VEST',
                'short_desc_zh' => '888 粗带',
                'desc_en' => '<p>888粗带</p>',
                'desc_zh' => '<p>888粗带</p>',
                'status' => '1',
                'created_at' => '2021-09-07 12:47:44',
                'updated_at' => '2021-09-09 12:49:21',
                'deleted_at' => NULL,
                'category_id' => 1,
            ),
            2 => 
            array (
                'id' => 3,
                'name_en' => '826 MULBERRY SILK',
                'name_zh' => '826 冰心云朵',
                'short_desc_en' => '826 MULBERRY SILK',
                'short_desc_zh' => '826 冰心云朵',
                'desc_en' => '<p>826冰心云朵</p>',
                'desc_zh' => '<p>826冰心云朵</p>',
                'status' => '1',
                'created_at' => '2021-09-07 12:48:11',
                'updated_at' => '2021-09-09 17:51:17',
                'deleted_at' => NULL,
                'category_id' => 1,
            ),
            3 => 
            array (
                'id' => 4,
                'name_en' => '555 SCULPT ROMANCE',
                'name_zh' => '555 小雕精',
                'short_desc_en' => '555 SCULPT ROMANCE',
                'short_desc_zh' => '555 小雕精',
                'desc_en' => '<p>555小雕精</p><p>ERYA sculpture without marks&nbsp;<br>SIZE : M , L , XL ,XXL&nbsp;<br>COLOUR : Diamond Black , Cherry Blossom Purple&nbsp;<br>PANTIES INCLUDED : S/M , L/XL , XXL</p><p>MAIN MATERIAL : Nylon 46% , Spandex 54%</p><p>LACE MATERIAL : Nylon 84.2% , Spandex 15.8%</p><p>Lace in the front of the bra is been inspired by the sexy French look , stylish and sexy.</p><p>It is made of 10D yarn the strands are even thinner then silk. It carries the 3A anti bacterial material which are anti moulding , soft to touch , anti wrinkle , good air circulation , lasting colour , light weight , prevent slagging of breast , won’t change shape easily.</p><p>It has invisible back buckle.</p><p>Thicker strips to prevent slipping and high elasticity.</p><p>It also has the “sandwich tech” which helps to give more support to the circumference.</p><p>Inner padding : 3D Bind Padding.</p><p>Panty included : Breathable , Fast drying , anti bacterial , seamless and tagless label&nbsp;</p>',
                'desc_zh' => '<p>555小雕精</p><p>ERYA无痕小雕精（塑胸蕾丝）<br>尺码&nbsp;：M，L，XL，XXL<br>颜色&nbsp;：曜石黑，樱花紫<br>配送内裤：S/M, &nbsp;L/XL, &nbsp;XXL</p><p>✿ 主面料：锦纶46% + 氨纶54%<br>✿ 蕾丝：锦纶84.2% + 氨纶15.8%<br><br>☛ 胸前蕾丝设计以”法国情怀“为主题，高尚且性感</p><p>☛ 10D超细旦（锦纶+氨纶），又成为锦纶丝，比桑蚕丝还要细。自带3A抗菌功能，防发霉，触感柔软，不易皱，透气性好，光泽度好，轻盈，悬垂性好，不易变形，冬暖夏凉</p><p>✿ 后背是可调节隐形排扣</p><p>✿ 粗肩带加宽设计，高弹性，防滑肩带</p><p>✿ 底围三文治工艺设计，可以稳固底围，同时支撑力十足<br>[圖片]</p><p>✿ 胸垫面料：高密棉，比一般的胸垫更加的硬挺。胸垫工艺：3D立体透气模杯，可塑造水滴型胸型</p><p>✿ 配送无痕抗菌内裤。无痕设计，无感标签，臀部包裹性更好，不卡裆。底裆甲壳素防霉抗菌除臭&nbsp;</p>',
                'status' => '1',
                'created_at' => '2021-09-07 12:48:29',
                'updated_at' => '2021-09-09 17:51:02',
                'deleted_at' => NULL,
                'category_id' => 1,
            ),
        ));
        
        
    }
}