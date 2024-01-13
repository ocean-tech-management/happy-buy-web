<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class OrderItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('order_items')->delete();
        
        \DB::table('order_items')->insert(array (
            0 =>
            array (
                'id' => 1,
                'product_name_en' => '999 CAMISOLE',
                'product_name_zh' => '999 细带',
                'short_desc_en' => NULL,
                'short_desc_zh' => NULL,
                'product_desc_en' => '<p>888 VEST</p><p>COLOUR : BEIGE , BLACK</p><p>SIZE : S, M, L, XL, XXL</p><p>PACKING : BOXED</p><p>&nbsp;</p><p>1. New upgrade of any cut fabric, soft and delicate cotton touch, comfortable and close-fitting, non feeling high elasticity, gentle care, meeting the needs of any period. The honeycomb wet guide in the front is visible when it meets water, so you will get healthy.</p><p>2. Ultra soft padding with upgraded elasticity, cotton soft touch, honeycomb vents, and cooling.Stuffy, the "U"-shaped far-infrared rays in the cup promote blood circulation, and the negative ions in the cup enhance body functions and improve sub-health. The coaster has a micro-elastic design in the center position, which is more stable to gather, and does not move or expand.</p><p>3. With widened hollow design, highlights the three-dimensional effect, stabilizes the chest shape and prevent slide up, and makes the body move free.</p><p>4. All-round mesh glue integrated molding&nbsp; black technology, neat and beautiful, enhanced expansion and contraction, no steel ring zero pressure, comfortable and breathable, perfect fit, heighten the side bones, gather the auxiliary breast, and show a perfect posture.</p><p>5. No sensation label, zero sensation.</p><p>&nbsp;</p><figure class="image"><img src="https://lh4.googleusercontent.com/cA4F2RbcQ9zy_tIO-Hw-ohUf5UbC4X7peiThUTpEN275Ijl5eaJHKVIiAxRzZfxdw_S9IXnMAtwgM6Cfemo2Rrt78kA0Tm46zt9YyKEt92HlvRk34mVJ5rCIloL8vxCeBt1CiYtO"></figure><figure class="image"><img src="https://lh6.googleusercontent.com/WOk8Fner6VE2DqvJTkOHs04a7xhHlfHXHoBEHhqA9JfHHk88raItsePCQt8ons_iYDl1uig5_VBOOqpbAaOVft12t10UEozb2lgWNZRqlRzdbF0M4w05aorN6mChw401okSDbUi4"></figure><figure class="image"><img src="https://lh5.googleusercontent.com/3FvzFxJj5ARcMyimsiRS6k8VfAn9yu8vKXbFdpCzMPF7NP9Yviqu4T3AqoFEiAECAEogo8hepxS-iLo0yVWeMs9hu3OEIZ5FEiONOXFSA9N8C3-S8R0Q92gU-JlW2WaCsB-sbD8_"></figure>',
                'product_desc_zh' => '<p>888背心款</p><p>颜色：肤色，黑色</p><p>码数：S，M，L，XL，XXL</p><p>包装：盒装</p><p>&nbsp;</p><p>&nbsp;</p><p>1、任意裁面料新升级，触感棉柔细腻，舒适贴身，无感高弹，温柔呵护，满足任何时期需求。前里蜂窝导湿格，遇水则显，随时掌握身体健康。</p><p>2、超Q乳罩杯，弹力升级，触感棉柔，蜂窝透气孔，排出热量不气。杯里“U”字型远红外线，促进血液循环，杯里负离子，增强身体机能，改善亚健康。杯垫心位微弹连带设计，更稳定聚拢，不游移不外扩。</p><p>3、三明治夹层，加宽镂空设计，凸显立体感，稳固胸型不上滑，身体活动更自如。</p><p>4、全方位网孔胶一体成型黑科技工艺，整洁美观，增强伸缩力度无钢圈零压力，舒适透气，完美贴身，加高侧骨位，收拢副乳，展现完美身姿。</p><p>5、无感标签，肌肤零感无刺激。</p><p>&nbsp;</p><figure class="image"><img src="https://lh5.googleusercontent.com/FIphLVufRVhp8JF5kImzRSnfz5Kg7pyCKizTb3efVDC3MTEZqLKVxByIxfQa2TcNOxpkunLDmXIY6i9GkMOIJZHmu-CKs6Y_E3kumlHYtGvUg4SQmyN_wfaJVJkV4v5bS0gO2k2A"></figure><figure class="image"><img src="https://lh5.googleusercontent.com/9pRZerPqS1z7CpBcu5PkhpOA7fOtpHvfn6em3DusQgL0ftfCK-bSL6XK4RCUQbLGApiY5jq2w8_mWNweo7JYt1TfVxGT_KBV9sm0OcNCPEzfTyeozXZPI2LbEEvnJn_-Xl_BoWop"></figure><figure class="image"><img src="https://lh5.googleusercontent.com/0TO27dmBdm2XZKVty1XYQ760FQ7CQ522IKbFXZZK3YCDT_sBwQ85twCC6hNYOMuCBiYc8REX-miX3fXi-J0sFCDryHH0-gKW2ZI3YSI8GKo3-MhA97w5ocvHZuil3ogicu08Uy0K"></figure>',
                'product_quantity' => '97',
                'product_color' => 'BLACK',
                'product_size' => 'M',
                'product_sku' => '999BlackM',
                'purchase_price' => '110',
                'sales_price' => '175',
                'merchant_president_price' => '90',
                'agent_director_price' => '100',
                'agent_executive_price' => '110',
                'price_add_on' => '2',
                'created_at' => '2021-12-31 10:28:31',
                'updated_at' => '2021-12-31 10:28:32',
                'deleted_at' => NULL,
                'product_id' => '1',
                'product_variant_id' => '2',
                'order_id' => '1',
            ),
            1 =>
            array (
                'id' => 2,
                'product_name_en' => '999 CAMISOLE',
                'product_name_zh' => '999 细带',
                'short_desc_en' => NULL,
                'short_desc_zh' => NULL,
                'product_desc_en' => '<p>888 VEST</p><p>COLOUR : BEIGE , BLACK</p><p>SIZE : S, M, L, XL, XXL</p><p>PACKING : BOXED</p><p>&nbsp;</p><p>1. New upgrade of any cut fabric, soft and delicate cotton touch, comfortable and close-fitting, non feeling high elasticity, gentle care, meeting the needs of any period. The honeycomb wet guide in the front is visible when it meets water, so you will get healthy.</p><p>2. Ultra soft padding with upgraded elasticity, cotton soft touch, honeycomb vents, and cooling.Stuffy, the "U"-shaped far-infrared rays in the cup promote blood circulation, and the negative ions in the cup enhance body functions and improve sub-health. The coaster has a micro-elastic design in the center position, which is more stable to gather, and does not move or expand.</p><p>3. With widened hollow design, highlights the three-dimensional effect, stabilizes the chest shape and prevent slide up, and makes the body move free.</p><p>4. All-round mesh glue integrated molding&nbsp; black technology, neat and beautiful, enhanced expansion and contraction, no steel ring zero pressure, comfortable and breathable, perfect fit, heighten the side bones, gather the auxiliary breast, and show a perfect posture.</p><p>5. No sensation label, zero sensation.</p><p>&nbsp;</p><figure class="image"><img src="https://lh4.googleusercontent.com/cA4F2RbcQ9zy_tIO-Hw-ohUf5UbC4X7peiThUTpEN275Ijl5eaJHKVIiAxRzZfxdw_S9IXnMAtwgM6Cfemo2Rrt78kA0Tm46zt9YyKEt92HlvRk34mVJ5rCIloL8vxCeBt1CiYtO"></figure><figure class="image"><img src="https://lh6.googleusercontent.com/WOk8Fner6VE2DqvJTkOHs04a7xhHlfHXHoBEHhqA9JfHHk88raItsePCQt8ons_iYDl1uig5_VBOOqpbAaOVft12t10UEozb2lgWNZRqlRzdbF0M4w05aorN6mChw401okSDbUi4"></figure><figure class="image"><img src="https://lh5.googleusercontent.com/3FvzFxJj5ARcMyimsiRS6k8VfAn9yu8vKXbFdpCzMPF7NP9Yviqu4T3AqoFEiAECAEogo8hepxS-iLo0yVWeMs9hu3OEIZ5FEiONOXFSA9N8C3-S8R0Q92gU-JlW2WaCsB-sbD8_"></figure>',
                'product_desc_zh' => '<p>888背心款</p><p>颜色：肤色，黑色</p><p>码数：S，M，L，XL，XXL</p><p>包装：盒装</p><p>&nbsp;</p><p>&nbsp;</p><p>1、任意裁面料新升级，触感棉柔细腻，舒适贴身，无感高弹，温柔呵护，满足任何时期需求。前里蜂窝导湿格，遇水则显，随时掌握身体健康。</p><p>2、超Q乳罩杯，弹力升级，触感棉柔，蜂窝透气孔，排出热量不气。杯里“U”字型远红外线，促进血液循环，杯里负离子，增强身体机能，改善亚健康。杯垫心位微弹连带设计，更稳定聚拢，不游移不外扩。</p><p>3、三明治夹层，加宽镂空设计，凸显立体感，稳固胸型不上滑，身体活动更自如。</p><p>4、全方位网孔胶一体成型黑科技工艺，整洁美观，增强伸缩力度无钢圈零压力，舒适透气，完美贴身，加高侧骨位，收拢副乳，展现完美身姿。</p><p>5、无感标签，肌肤零感无刺激。</p><p>&nbsp;</p><figure class="image"><img src="https://lh5.googleusercontent.com/FIphLVufRVhp8JF5kImzRSnfz5Kg7pyCKizTb3efVDC3MTEZqLKVxByIxfQa2TcNOxpkunLDmXIY6i9GkMOIJZHmu-CKs6Y_E3kumlHYtGvUg4SQmyN_wfaJVJkV4v5bS0gO2k2A"></figure><figure class="image"><img src="https://lh5.googleusercontent.com/9pRZerPqS1z7CpBcu5PkhpOA7fOtpHvfn6em3DusQgL0ftfCK-bSL6XK4RCUQbLGApiY5jq2w8_mWNweo7JYt1TfVxGT_KBV9sm0OcNCPEzfTyeozXZPI2LbEEvnJn_-Xl_BoWop"></figure><figure class="image"><img src="https://lh5.googleusercontent.com/0TO27dmBdm2XZKVty1XYQ760FQ7CQ522IKbFXZZK3YCDT_sBwQ85twCC6hNYOMuCBiYc8REX-miX3fXi-J0sFCDryHH0-gKW2ZI3YSI8GKo3-MhA97w5ocvHZuil3ogicu08Uy0K"></figure>',
                'product_quantity' => '1',
                'product_color' => 'BLACK',
                'product_size' => 'S',
                'product_sku' => '999BlackS',
                'purchase_price' => '110',
                'sales_price' => '175',
                'merchant_president_price' => '90',
                'agent_director_price' => '100',
                'agent_executive_price' => '110',
                'price_add_on' => '2',
                'created_at' => '2021-12-31 10:44:33',
                'updated_at' => '2021-12-31 10:44:33',
                'deleted_at' => NULL,
                'product_id' => '1',
                'product_variant_id' => '1',
                'order_id' => '2',
            ),
            2 =>
            array (
                'id' => 3,
                'product_name_en' => '999 CAMISOLE',
                'product_name_zh' => '999 细带',
                'short_desc_en' => NULL,
                'short_desc_zh' => NULL,
                'product_desc_en' => '<p>888 VEST</p><p>COLOUR : BEIGE , BLACK</p><p>SIZE : S, M, L, XL, XXL</p><p>PACKING : BOXED</p><p>&nbsp;</p><p>1. New upgrade of any cut fabric, soft and delicate cotton touch, comfortable and close-fitting, non feeling high elasticity, gentle care, meeting the needs of any period. The honeycomb wet guide in the front is visible when it meets water, so you will get healthy.</p><p>2. Ultra soft padding with upgraded elasticity, cotton soft touch, honeycomb vents, and cooling.Stuffy, the "U"-shaped far-infrared rays in the cup promote blood circulation, and the negative ions in the cup enhance body functions and improve sub-health. The coaster has a micro-elastic design in the center position, which is more stable to gather, and does not move or expand.</p><p>3. With widened hollow design, highlights the three-dimensional effect, stabilizes the chest shape and prevent slide up, and makes the body move free.</p><p>4. All-round mesh glue integrated molding&nbsp; black technology, neat and beautiful, enhanced expansion and contraction, no steel ring zero pressure, comfortable and breathable, perfect fit, heighten the side bones, gather the auxiliary breast, and show a perfect posture.</p><p>5. No sensation label, zero sensation.</p><p>&nbsp;</p><figure class="image"><img src="https://lh4.googleusercontent.com/cA4F2RbcQ9zy_tIO-Hw-ohUf5UbC4X7peiThUTpEN275Ijl5eaJHKVIiAxRzZfxdw_S9IXnMAtwgM6Cfemo2Rrt78kA0Tm46zt9YyKEt92HlvRk34mVJ5rCIloL8vxCeBt1CiYtO"></figure><figure class="image"><img src="https://lh6.googleusercontent.com/WOk8Fner6VE2DqvJTkOHs04a7xhHlfHXHoBEHhqA9JfHHk88raItsePCQt8ons_iYDl1uig5_VBOOqpbAaOVft12t10UEozb2lgWNZRqlRzdbF0M4w05aorN6mChw401okSDbUi4"></figure><figure class="image"><img src="https://lh5.googleusercontent.com/3FvzFxJj5ARcMyimsiRS6k8VfAn9yu8vKXbFdpCzMPF7NP9Yviqu4T3AqoFEiAECAEogo8hepxS-iLo0yVWeMs9hu3OEIZ5FEiONOXFSA9N8C3-S8R0Q92gU-JlW2WaCsB-sbD8_"></figure>',
                'product_desc_zh' => '<p>888背心款</p><p>颜色：肤色，黑色</p><p>码数：S，M，L，XL，XXL</p><p>包装：盒装</p><p>&nbsp;</p><p>&nbsp;</p><p>1、任意裁面料新升级，触感棉柔细腻，舒适贴身，无感高弹，温柔呵护，满足任何时期需求。前里蜂窝导湿格，遇水则显，随时掌握身体健康。</p><p>2、超Q乳罩杯，弹力升级，触感棉柔，蜂窝透气孔，排出热量不气。杯里“U”字型远红外线，促进血液循环，杯里负离子，增强身体机能，改善亚健康。杯垫心位微弹连带设计，更稳定聚拢，不游移不外扩。</p><p>3、三明治夹层，加宽镂空设计，凸显立体感，稳固胸型不上滑，身体活动更自如。</p><p>4、全方位网孔胶一体成型黑科技工艺，整洁美观，增强伸缩力度无钢圈零压力，舒适透气，完美贴身，加高侧骨位，收拢副乳，展现完美身姿。</p><p>5、无感标签，肌肤零感无刺激。</p><p>&nbsp;</p><figure class="image"><img src="https://lh5.googleusercontent.com/FIphLVufRVhp8JF5kImzRSnfz5Kg7pyCKizTb3efVDC3MTEZqLKVxByIxfQa2TcNOxpkunLDmXIY6i9GkMOIJZHmu-CKs6Y_E3kumlHYtGvUg4SQmyN_wfaJVJkV4v5bS0gO2k2A"></figure><figure class="image"><img src="https://lh5.googleusercontent.com/9pRZerPqS1z7CpBcu5PkhpOA7fOtpHvfn6em3DusQgL0ftfCK-bSL6XK4RCUQbLGApiY5jq2w8_mWNweo7JYt1TfVxGT_KBV9sm0OcNCPEzfTyeozXZPI2LbEEvnJn_-Xl_BoWop"></figure><figure class="image"><img src="https://lh5.googleusercontent.com/0TO27dmBdm2XZKVty1XYQ760FQ7CQ522IKbFXZZK3YCDT_sBwQ85twCC6hNYOMuCBiYc8REX-miX3fXi-J0sFCDryHH0-gKW2ZI3YSI8GKo3-MhA97w5ocvHZuil3ogicu08Uy0K"></figure>',
                'product_quantity' => '1',
                'product_color' => 'BLACK',
                'product_size' => 'M',
                'product_sku' => '999BlackM',
                'purchase_price' => '110',
                'sales_price' => '175',
                'merchant_president_price' => '90',
                'agent_director_price' => '100',
                'agent_executive_price' => '110',
                'price_add_on' => '2',
                'created_at' => '2021-12-31 11:18:24',
                'updated_at' => '2021-12-31 11:18:24',
                'deleted_at' => NULL,
                'product_id' => '1',
                'product_variant_id' => '1',
                'order_id' => '3',
            ),
            3  =>
            array (
                'id' => 4,
                'product_name_en' => '999 CAMISOLE',
                'product_name_zh' => '999 细带',
                'short_desc_en' => NULL,
                'short_desc_zh' => NULL,
                'product_desc_en' => '<p>888 VEST</p><p>COLOUR : BEIGE , BLACK</p><p>SIZE : S, M, L, XL, XXL</p><p>PACKING : BOXED</p><p>&nbsp;</p><p>1. New upgrade of any cut fabric, soft and delicate cotton touch, comfortable and close-fitting, non feeling high elasticity, gentle care, meeting the needs of any period. The honeycomb wet guide in the front is visible when it meets water, so you will get healthy.</p><p>2. Ultra soft padding with upgraded elasticity, cotton soft touch, honeycomb vents, and cooling.Stuffy, the "U"-shaped far-infrared rays in the cup promote blood circulation, and the negative ions in the cup enhance body functions and improve sub-health. The coaster has a micro-elastic design in the center position, which is more stable to gather, and does not move or expand.</p><p>3. With widened hollow design, highlights the three-dimensional effect, stabilizes the chest shape and prevent slide up, and makes the body move free.</p><p>4. All-round mesh glue integrated molding&nbsp; black technology, neat and beautiful, enhanced expansion and contraction, no steel ring zero pressure, comfortable and breathable, perfect fit, heighten the side bones, gather the auxiliary breast, and show a perfect posture.</p><p>5. No sensation label, zero sensation.</p><p>&nbsp;</p><figure class="image"><img src="https://lh4.googleusercontent.com/cA4F2RbcQ9zy_tIO-Hw-ohUf5UbC4X7peiThUTpEN275Ijl5eaJHKVIiAxRzZfxdw_S9IXnMAtwgM6Cfemo2Rrt78kA0Tm46zt9YyKEt92HlvRk34mVJ5rCIloL8vxCeBt1CiYtO"></figure><figure class="image"><img src="https://lh6.googleusercontent.com/WOk8Fner6VE2DqvJTkOHs04a7xhHlfHXHoBEHhqA9JfHHk88raItsePCQt8ons_iYDl1uig5_VBOOqpbAaOVft12t10UEozb2lgWNZRqlRzdbF0M4w05aorN6mChw401okSDbUi4"></figure><figure class="image"><img src="https://lh5.googleusercontent.com/3FvzFxJj5ARcMyimsiRS6k8VfAn9yu8vKXbFdpCzMPF7NP9Yviqu4T3AqoFEiAECAEogo8hepxS-iLo0yVWeMs9hu3OEIZ5FEiONOXFSA9N8C3-S8R0Q92gU-JlW2WaCsB-sbD8_"></figure>',
                'product_desc_zh' => '<p>888背心款</p><p>颜色：肤色，黑色</p><p>码数：S，M，L，XL，XXL</p><p>包装：盒装</p><p>&nbsp;</p><p>&nbsp;</p><p>1、任意裁面料新升级，触感棉柔细腻，舒适贴身，无感高弹，温柔呵护，满足任何时期需求。前里蜂窝导湿格，遇水则显，随时掌握身体健康。</p><p>2、超Q乳罩杯，弹力升级，触感棉柔，蜂窝透气孔，排出热量不气。杯里“U”字型远红外线，促进血液循环，杯里负离子，增强身体机能，改善亚健康。杯垫心位微弹连带设计，更稳定聚拢，不游移不外扩。</p><p>3、三明治夹层，加宽镂空设计，凸显立体感，稳固胸型不上滑，身体活动更自如。</p><p>4、全方位网孔胶一体成型黑科技工艺，整洁美观，增强伸缩力度无钢圈零压力，舒适透气，完美贴身，加高侧骨位，收拢副乳，展现完美身姿。</p><p>5、无感标签，肌肤零感无刺激。</p><p>&nbsp;</p><figure class="image"><img src="https://lh5.googleusercontent.com/FIphLVufRVhp8JF5kImzRSnfz5Kg7pyCKizTb3efVDC3MTEZqLKVxByIxfQa2TcNOxpkunLDmXIY6i9GkMOIJZHmu-CKs6Y_E3kumlHYtGvUg4SQmyN_wfaJVJkV4v5bS0gO2k2A"></figure><figure class="image"><img src="https://lh5.googleusercontent.com/9pRZerPqS1z7CpBcu5PkhpOA7fOtpHvfn6em3DusQgL0ftfCK-bSL6XK4RCUQbLGApiY5jq2w8_mWNweo7JYt1TfVxGT_KBV9sm0OcNCPEzfTyeozXZPI2LbEEvnJn_-Xl_BoWop"></figure><figure class="image"><img src="https://lh5.googleusercontent.com/0TO27dmBdm2XZKVty1XYQ760FQ7CQ522IKbFXZZK3YCDT_sBwQ85twCC6hNYOMuCBiYc8REX-miX3fXi-J0sFCDryHH0-gKW2ZI3YSI8GKo3-MhA97w5ocvHZuil3ogicu08Uy0K"></figure>',
                'product_quantity' => '2',
                'product_color' => 'BLACK',
                'product_size' => 'S',
                'product_sku' => '999BlackS',
                'purchase_price' => '110',
                'sales_price' => '175',
                'merchant_president_price' => '90',
                'agent_director_price' => '100',
                'agent_executive_price' => '110',
                'price_add_on' => '2',
                'created_at' => '2021-12-31 11:21:28',
                'updated_at' => '2021-12-31 11:21:28',
                'deleted_at' => NULL,
                'product_id' => '1',
                'product_variant_id' => '1',
                'order_id' => '4',
            ),
            4  =>
            array (
                'id' => 5,
                'product_name_en' => '999 CAMISOLE',
                'product_name_zh' => '999 细带',
                'short_desc_en' => NULL,
                'short_desc_zh' => NULL,
                'product_desc_en' => '<p>888 VEST</p><p>COLOUR : BEIGE , BLACK</p><p>SIZE : S, M, L, XL, XXL</p><p>PACKING : BOXED</p><p>&nbsp;</p><p>1. New upgrade of any cut fabric, soft and delicate cotton touch, comfortable and close-fitting, non feeling high elasticity, gentle care, meeting the needs of any period. The honeycomb wet guide in the front is visible when it meets water, so you will get healthy.</p><p>2. Ultra soft padding with upgraded elasticity, cotton soft touch, honeycomb vents, and cooling.Stuffy, the "U"-shaped far-infrared rays in the cup promote blood circulation, and the negative ions in the cup enhance body functions and improve sub-health. The coaster has a micro-elastic design in the center position, which is more stable to gather, and does not move or expand.</p><p>3. With widened hollow design, highlights the three-dimensional effect, stabilizes the chest shape and prevent slide up, and makes the body move free.</p><p>4. All-round mesh glue integrated molding&nbsp; black technology, neat and beautiful, enhanced expansion and contraction, no steel ring zero pressure, comfortable and breathable, perfect fit, heighten the side bones, gather the auxiliary breast, and show a perfect posture.</p><p>5. No sensation label, zero sensation.</p><p>&nbsp;</p><figure class="image"><img src="https://lh4.googleusercontent.com/cA4F2RbcQ9zy_tIO-Hw-ohUf5UbC4X7peiThUTpEN275Ijl5eaJHKVIiAxRzZfxdw_S9IXnMAtwgM6Cfemo2Rrt78kA0Tm46zt9YyKEt92HlvRk34mVJ5rCIloL8vxCeBt1CiYtO"></figure><figure class="image"><img src="https://lh6.googleusercontent.com/WOk8Fner6VE2DqvJTkOHs04a7xhHlfHXHoBEHhqA9JfHHk88raItsePCQt8ons_iYDl1uig5_VBOOqpbAaOVft12t10UEozb2lgWNZRqlRzdbF0M4w05aorN6mChw401okSDbUi4"></figure><figure class="image"><img src="https://lh5.googleusercontent.com/3FvzFxJj5ARcMyimsiRS6k8VfAn9yu8vKXbFdpCzMPF7NP9Yviqu4T3AqoFEiAECAEogo8hepxS-iLo0yVWeMs9hu3OEIZ5FEiONOXFSA9N8C3-S8R0Q92gU-JlW2WaCsB-sbD8_"></figure>',
                'product_desc_zh' => '<p>888背心款</p><p>颜色：肤色，黑色</p><p>码数：S，M，L，XL，XXL</p><p>包装：盒装</p><p>&nbsp;</p><p>&nbsp;</p><p>1、任意裁面料新升级，触感棉柔细腻，舒适贴身，无感高弹，温柔呵护，满足任何时期需求。前里蜂窝导湿格，遇水则显，随时掌握身体健康。</p><p>2、超Q乳罩杯，弹力升级，触感棉柔，蜂窝透气孔，排出热量不气。杯里“U”字型远红外线，促进血液循环，杯里负离子，增强身体机能，改善亚健康。杯垫心位微弹连带设计，更稳定聚拢，不游移不外扩。</p><p>3、三明治夹层，加宽镂空设计，凸显立体感，稳固胸型不上滑，身体活动更自如。</p><p>4、全方位网孔胶一体成型黑科技工艺，整洁美观，增强伸缩力度无钢圈零压力，舒适透气，完美贴身，加高侧骨位，收拢副乳，展现完美身姿。</p><p>5、无感标签，肌肤零感无刺激。</p><p>&nbsp;</p><figure class="image"><img src="https://lh5.googleusercontent.com/FIphLVufRVhp8JF5kImzRSnfz5Kg7pyCKizTb3efVDC3MTEZqLKVxByIxfQa2TcNOxpkunLDmXIY6i9GkMOIJZHmu-CKs6Y_E3kumlHYtGvUg4SQmyN_wfaJVJkV4v5bS0gO2k2A"></figure><figure class="image"><img src="https://lh5.googleusercontent.com/9pRZerPqS1z7CpBcu5PkhpOA7fOtpHvfn6em3DusQgL0ftfCK-bSL6XK4RCUQbLGApiY5jq2w8_mWNweo7JYt1TfVxGT_KBV9sm0OcNCPEzfTyeozXZPI2LbEEvnJn_-Xl_BoWop"></figure><figure class="image"><img src="https://lh5.googleusercontent.com/0TO27dmBdm2XZKVty1XYQ760FQ7CQ522IKbFXZZK3YCDT_sBwQ85twCC6hNYOMuCBiYc8REX-miX3fXi-J0sFCDryHH0-gKW2ZI3YSI8GKo3-MhA97w5ocvHZuil3ogicu08Uy0K"></figure>',
                'product_quantity' => '1',
                'product_color' => 'BLACK',
                'product_size' => 'S',
                'product_sku' => '999BlackS',
                'purchase_price' => '110',
                'sales_price' => '175',
                'merchant_president_price' => '90',
                'agent_director_price' => '100',
                'agent_executive_price' => '110',
                'price_add_on' => '2',
                'created_at' => '2021-12-31 14:30:56',
                'updated_at' => '2021-12-31 14:30:56',
                'deleted_at' => NULL,
                'product_id' => '1',
                'product_variant_id' => '1',
                'order_id' => '5',
            ),
        ));
    }
}
