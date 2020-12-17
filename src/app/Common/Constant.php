<?php
/**
 * 常量
 * Created by PhpStorm.
 * User: 刘瑞
 * Date: 2018/11/26
 * Time: 14:52
 */

namespace App\Common;

class Constant
{
    /**
     * 默认分页数
     */
    const PAGE = 1;

    /**
     * 默认分页数
     */
    const LIMIT = 10;

    /**
     * 订单是否管理商品信息 1：是，2：否 1
     */
    const ORDER_GOODS_TRUE = 1;

    /**
     * 订单是否管管理商品信息 1：是，2：否 1
     */
    const ORDER_GOODS_FALSE = 2;

    /**
     * 订单是否关联用户信息 1：是，2：否 1
     */
    const ORDER_USER_TRUE = 1;

    /**
     * 订单是否关联赠品信息 1：是，2：否 2
     */
    const ORDER_GIFT_FALSE = 2;

    /**
     * 订单是否关联赠品信息 1：是，2：否 1
     */
    const ORDER_GIFT_TRUE = 1;

    /**
     * 订单是否管理支付信息 1：是，2：否 1
     */
    const ORDER_PAY_TRUE = 1;

    /**
     * 订单是否关联退款信息 1：是，2：否 1
     */
    const ORDER_REFUND_TRUE = 1;

    /**
     * 成功码
     */
    const SUCCESS_CODE = 0;

    /**
     * 保留小数位
     */
    const DECIMAL = 2;

    /**
     * 已秒为单位
     */
    const TIME_SECOND = 2;

    /**
     * 以元为单位
     */
    const MONEY_UNIT = 100;

    /**
     * 上架
     */
    const UP_SHELVES_STATUS = 1;

    /**
     * 下架
     */
    const UP_SHELVES_STATUS_FASLE = 1;

    /**
     * 类型价格
     */
    const SPU_PRICE = 3;

    /**
     * 开启sku
     */
    const OPEN_SKU = 1;

    /**
     * 按订单金额
     */
    const ORDER_SORT = 1;

    /**
     * 按订单数量排序
     */
    const ORDER_NUMBER = 2;

    /**
     * 今日
     */
    const DAY = 1;

    /**
     * 本周
     */
    const WEEK = 2;

    /**
     * 本月
     */
    const MONTH = 3;

    /**
     * 完成
     */
    const ACCOMPLISH = 2;

    /**
     * 订单状态
     */
    const TRADE_ORDER_UNPAID = 1;

    /**
     * 订单
     */
    const ORDER_USER = 3;

    /**
     * 会员任务
     */
    const USER_TASK = 1;

    /**
     * 最小支付金额
     */
    const ORDER_MIN_PRICE = 1;

    /**
     * 如果是负数支付金额为0
     */
    const ORDER_MIN_PRICE_HELP = 0;

    /**
     * 已开抢
     */
    const SNAP_UP_START = 1;

    /**
     * 已开抢
     */
    const SNAP_UP_ONGOING = 2;

    /**
     * 未开始
     */
    const SNAP_UP_NOT = 3;

    /**
     * 距离开始时间X分钟
     */
    const START_TIME = 10;

    /**
     * 秒杀库存前缀
     */
    const SECKILL_INVENTORY = 'seckill_inventory_';

    /**
     * 秒杀库存是否已经添加过
     */
    const SECKILL_INVENTORY_TRUE = 'seckill_inventory_true_';

    /**
     * 秒杀延迟队列下单检查前缀
     */
    const SECKILL_ORDER_LIST = 'seckill_order_list';

    /**
     * 秒杀
     */
    const SECKILL = 3;

    /**
     * 助力
     */
    const HELP = 6;


    /**
     * 秒杀提醒队列前缀
     */
    const SECKILL_REMIND = 'seckill_remind_';

    /**
     * 秒杀提醒集合前缀
     */
    const SECKILL_REMIND_GATHER = 'seckill_remind_gather_';

    /**
     * 订单失效时间(秒)
     */
    const ORDER_TIME_EFFECTIVE = 302;

    /**
     * 秒杀订单支付失效时间(秒)
     */
    const ORDER_TIME_EFFECTIVE_PY = 300;

    /**
     * 普通订单支付失效时间(秒)
     */
    const GROUP_CANCEL_TIME = 898;

    /**
     * 秒杀订单延迟任务名称
     */
    const SECKILL_ORDER = 'seckill_order';

    /**
     * 助力延迟任务
     */
    const HELP_USER = 'help_user';

    /**
     * 助力支付延迟队列
     */
    const HELP_PAY = 'help_pay';

    /**
     * 助力活动结束延迟队列
     */
    const HELP_OVER = 'help_over';

    /**
     * 秒杀提醒延迟任务名称
     */
    const SECKILL_REMIND_LIST = 'seckill_remind_list';

    /**
     * 开团拼团延时任务名称
     */
    const OPEN_GROUP_LIST = 'open_group_list';

    /**
     * 参团拼团延时任务名称
     */
    const JOIN_GROUP_LIST = 'join_group_list';

    /**
     * 新品延时任务名称
     */
    const NOVICE_LIST = 'novice_list';

    /**
     * 退款延时任务名称
     */
    const GROUP_REFUND_LIST = 'group_refund_list';

    /**
     * 上传头像任务名称
     */
    const UPLOAD_AVATAR = 'upload_avatar';

    /**
     * 启用
     */
    const SKU_TRUE = 1;

    /**
     * 禁用
     */
    const SKU_FALSE = 2;

    /**
     * 最小订单金额
     */
    const PAY_MIN_MONEY = 1;

    /**
     * 微信执行成功
     */
    const SUCCESS = 'SUCCESS';

    // 应用安装状态 1=已安装 2=未安装
    const ENTERPRISE_INSTALL_STATUS = 1;
    const ENTERPRISE_UNINSTALLED_STATUS = 2;

    // 礼劵企业应用标示
    const APP_IDENTITY_COUPON = 'coupon';
    // 新人优惠企业应用标示
    const APP_IDENTITY_NOVICE = 'novice';
    // 秒杀限时购企业应用标示
    const APP_IDENTITY_SEC_KILL = 'sec_kill';
    // 拼团企业应用标示
    const APP_IDENTITY_GROUP = 'group';

    // 画像年龄统计 类型(1=小于20岁，2=20-24岁，3=25-29岁，4=30-34岁，5=35-39岁,6=40-49岁，7=50岁及以上，8=保密)
    const LESS_THAN_TWENTY_TYPE = 1;
    const TWENTY_TO_TWENTY_FOUR_TYPE = 2;
    const TWENTY_FIVE_TO_TWENTY_NINE_TYPE = 3;
    const THIRTY_TO_THIRTY_FOUR_TYPE = 4;
    const THIRTY_FIVE_TO_THIRTY_NINE_TYPE = 5;
    const FORTY_TO_FORTY_NINE_TYPE = 6;
    const FIFTY_TO_TYPE = 7;
    const SECRECY_TYPE = 8;

    // 印象标签
    const IMPRESSION_LABEL = 2;
    // 系统标签
    const SYSTEM_LABEL = 1;

    // 开启标签状态
    const OPEN_LABEL_STATUS = 1;

    // 中国省份数据
    const CHINA_PROVINCE = [
        '甘肃',
        '青海',
        '广西',
        '贵州',
        '重庆',
        '北京',
        '福建',
        '安徽',
        '广东',
        '西藏',
        '新疆',
        '海南',
        '宁夏',
        '陕西',
        '山西',
        '湖北',
        '湖南',
        '四川',
        '云南',
        '河北',
        '河南',
        '辽宁',
        '辽宁',
        '天津',
        '江西',
        '江苏',
        '上海',
        '浙江',
        '吉林',
        '内蒙古',
        '黑龙江',
        '台湾',
        '香港',
        '澳门'
    ];

    // 省类型
    const PROVINCE_TYPE = 1;
    // 市类型
    const CITY_TYPE = 2;

    /*
     * 支付类型 1 微信
     */
    const PAY_TYPE_WEIXIN = 1;

    /*
     * 小程序分类页面redis缓存key
     */
    const CATEGORY_GOODS_KEY = 'category_goods_key:';

    /**
     * 申请取消已支付订单延迟任务名称
     */
    const CANCEL_ORDER = 'cancel_order';

    /**
     * 取消订单延迟任务名称
     */
    const WX_REFUND_JOB = 'wx_refund_job';

    /**
     * 是否同意用户收藏有礼的提交 1：未审核 2：已同意 3：拒绝
     */
    const COLLECTION_REFUSE = 3;

    /**
     * 是否同意用户收藏有礼的提交 1：未审核 2：已同意 3：拒绝
     */
    const COLLECTION_AGREE = 2;

    /**
     * 收藏有礼审核通过 发送消息
     */
    const COLLECTION_MESSAGE_AGREE = 11;

    /**
     * 收藏有礼审核未通过 发送消息
     */
    const COLLECTION_MESSAGE_REFUSE = 12;

    /**
     * 礼券是否使用  1:待使用，2:使用中，3:已使用
     */
    const COUPON_USE_TRUE = 3;

    /**
     * 礼券是否使用  1:待使用，2:使用中，3:已使用
     */
    const COUPON_USE_WAITING = 1;

    /**
     * 小程序应用类型: 1商城小程序、2企业微信小程序 1
     */
    const APP_TYPE = 1;

    /**
     * 1:收藏有礼开启  2：收藏有礼关闭
     */
    const COLLECTION_FASLE = 2;

    /**
     * 1：是否线上使用
     */
    const TEMPALTE_IS_USE = 1;

    /**
     * 是否赠品 默认 1：否 2=是
     */
    const GIFT_UN_GOODS = 1;
    const GIFT_GOODS = 2;

    /**
     * 草稿
     */
    const DRAFT_TRUE = 1;

    /**
     * 状态 0：未发布
     *      0：未发布  1：审核中  2：审核成功  3：审核失败
     */
    const UNPUBLISHED = 0;

    /**
     * 状态 1：审核中
     *      0：未发布  1：审核中  2：审核成功  3：审核失败
     */
    const AUDIT = 1;

    /**
     * 我的模板
     */
    const MY_TEMPLATE = 3;

    /**
     * 已经过期
     */
    const MY_HELP_FASLE = 3;


    /**
     * 上下移动
     */
    const SORT_UP = 1;
    const SORT_DOWN = 2;

    /**
     * 全场满赠满减满折活动格式化类型：订单
     */
    const FULL_ACTIVITY_FORMAT_TYPE_ORDER = 1;

    /**
     * 全场满赠满减满折活动格式化类型：购物车
     */
    const FULL_ACTIVITY_FORMAT_TYPE_CART = 2;

    /**
     * 是否转换折扣：是
     */
    const CONVERT_DISCOUNT_TRUE = 1;

    /**
     * 是否转换折扣：否
     */
    const CONVERT_DISCOUNT_FALSE = 2;

    /**
     * 正在助力
     */
    const HELP_START = 1;

    /**
     * 助力完成
     */
    const HELP_TRUE = 2;

    /**
     * 助力活动结束
     */
    const HELP_STATE_OVER = 3;

    /**
     * 助力完成 未获得奖品
     */
    const HELP_OBTAIN_FALSE = 4;

    /**
     * 订单全场活动是否验证条件：是
     */
    const FULL_ACTIVITY_VALID_CONDITION_TRUE = 1;

    /**
     * 订单全场活动是否验证条件：否
     */
    const FULL_ACTIVITY_VALID_CONDITION_FALSE = 2;

    /**
     * 小程序是否标准版：否
     */
    const APP_TYPE_STANDARD_FALSE = 1;
    /**
     * 小程序是否标准版：是
     */
    const APP_TYPE_STANDARD_TRUE = 2;

    // 企业配置类型 1=好物圈 2=商品详情 3用户授权 4=购物车页面 5=商品分类页
    const CONFIG_WX_Mall_TYPE = 1;
    const CONFIG_GOODS_INFO_TYPE = 2;
    const CONFIG_ORDER_EMPOWER_TYPE = 3;
    const CONFIG_CART_TYPE = 4;
    const CONFIG_CATEGORY_TYPE = 5;
    const CONFIG_ORDER_TYPE = 6;

    // 企业配置开启状态：开启
    const CONFIG_OPEN_TRUE = 1;
    // 企业配置开启状态：关闭
    const CONFIG_OPEN_FALSE = 2;

    // 默认好物圈开关未开启
    const GOODS_DETAIL_MALL_OPEN = 2;
    /**
     * 活动砍价是否是固定形式 1：随机 2：固定
     */
    const BARGAIN_FIXED = 2;

    /**
     * 活动砍价是否是固定形式 1：随机 2：固定
     */
    const BARGAIN_RANDOM = 1;

    /**
     * 砍价中
     */
    const BARGAIN_WAITING = 1;

    /**
     * 砍价完成
     */
    const BARGAIN_TRUE = 2;

    /**
     * 砍价失败
     */
    const BARGAIN_FALSE = 3;

    /**
     * 砍价完成未生成订单
     */
    const BARGAIN_ORDER_FALSE = 4;

    /**
     * 砍价活动结束延迟队列
     */
    const BARGAIN_OVER = 'bargain_over';

    /**
     * 砍价延迟任务
     */
    const BARGAIN_USER = 'bargain_user';

    /**
     * 最佳组合用户选中数量
     */
    const CHECK_NUM_ONE = 1;
    const CHECK_NUM_TWO = 2;
    /**
     * 分类商品活动：无活动
     */
    const CATEGORY_GOODS_ACTIVITY_GOODS = 0;

    /**
     * 分类商品活动：超低购
     */
    const CATEGORY_GOODS_ACTIVITY_CHEAP = 1;

    /**
     * 分类商品活动：拼团
     */
    const CATEGORY_GOODS_ACTIVITY_GROUP = 2;

    // 已上架模板状态(1=不存在 2=存在)
    const TEMPLATE_NOT_EXISTENCE = 1;
    const TEMPLATE_EXISTENCE = 2;

    // 凑单排序 1=综合降 2=综合升2=销量升 3=销量降 4=价格升 5=价格降
    CONST ORDER_BY_ID_DESC = 1;
    CONST ORDER_BY_ID_ASC = 2;
    CONST ORDER_BY_SALE_ASC = 3;
    CONST ORDER_BY_SALE_DESC = 4;
    CONST ORDER_BY_PRICE_ASC = 5;
    CONST ORDER_BY_PRICE_DESC = 6;

    // 凑单类型 1=按金额 2=按数量
    CONST PRICE_TYPE = 1;
    CONST NUM_TYPE = 2;


    /**
     * 红点标识显示：是
     */
    const RED_DOT_STATUS_TRUE = 1;
    /**
     * 红点标识显示：否
     */
    const RED_DOT_STATUS_FALSE = 2;
    /**
     * 红点标识类型：优惠券
     */
    const RED_DOT_TYPE_COUPON = 1;
    /**
     * 红点标识类型：订单
     */
    const RED_DOT_TYPE_ORDER = 2;

    // 1=购物车更新库存类型 2=购物车sku更换类型或合并sku库存类型 3=凑单
    const CART_UPDATE_STOCK_TYPE = 1;
    const CART_UPDATE_SKU_STOCK_TYPE = 2;
    const CART_UPDATE_BILLS_STOCK_TYPE = 3;


    /**
     * 未开始
     */
    const ACTIVITY_TRUE = 1;

    /**
     * 活动进行中
     */
    const ACTIVITY_START = 2;

    /**
     * 活动结束
     */
    const ACTIVITY_OVER = 3;

    /**
     * 身份 1:发起
     */
    const IDENTITY_INITIATE = 1;

    /**
     * 身份 2:点赞
     */
    const IDENTITY_HELP = 2;

    /**
     * 身份 3:普通
     */
    const IDENTITY_ORDINARY = 3;

    /**
     * 正在进行
     */
    const  ONGOING = 1;

    /**
     * 成功
     */
    const SUCCEED = 2;

    /**
     * 失败
     */
    const FAILURE = 3;

    const NEW_MAIN_PIC = [
        "sqb_fllk199-130"     => "https://cdn.haowuji123.com/upload/ad/sqb_fllk199-130.jpeg",
        "sqb_xpp199-115"     => "https://cdn.haowuji123.com/upload/ad/sqb_xpp15323330.jpeg",
        "sqb_bcw299-215"     => "https://cdn.haowuji123.com/upload/ad/sqb_bcw15314223.jpg",
        "sqb_bw199-100"      => "https://cdn.haowuji123.com/upload/ad/sqb_bw15322991.jpeg",
        "sqb_ryytn110.1-110" => "https://cdn.haowuji123.com/upload/ad/sqb_ryytn15314036.jpg",
        "sqb_njr99-60"       => "https://cdn.haowuji123.com/upload/ad/sqb_njr15314060.jpg",
        "sqb_lyl199-110"     => "https://cdn.haowuji123.com/upload/ad/sqb_lyl15313944.jpg",
        "sqb_wbq199-130"     => "https://cdn.haowuji123.com/upload/ad/sqb_wbq15313943.jpg",
        "sqb_bql169-130"     => "https://cdn.haowuji123.com/upload/ad/sqb_bql15313942.jpg",
        "sqb_wd199-120"      => "https://cdn.haowuji123.com/upload/ad/sql_wd15299255.jpeg",
        "sqb_wd199-115"      => "https://cdn.haowuji123.com/upload/ad/wd15276669_1124.jpeg",
        "fb_hdy"             => "https://cdn.haowuji123.com/upload/ad/fb_hdy20201215.jpeg",
        "fb_ssh169-130"      => "https://cdn.haowuji123.com/upload/ad/fb_ssh15322927.jpeg",
        "fb_fllk199-130"     => "https://cdn.haowuji123.com/upload/ad/fb_fllk15323021.jpeg",
        "fb_yyz199-130"      => "https://cdn.haowuji123.com/upload/ad/yyz15262217.jpeg",
        "fb_bcw299-215"      => "https://cdn.haowuji123.com/upload/ad/bcw15262041.png",
        "fb_bql169-130"      => "https://cdn.haowuji123.com/upload/ad/bql15226430.jpg",
        "fb_wd199-120"       => "https://cdn.haowuji123.com/upload/ad/wd15243121.jpeg",
        "fb_njr99-60"        => "https://cdn.haowuji123.com/upload/ad/njr15226635.png",
        "fb_ryytn110.01-110" => "https://cdn.haowuji123.com/upload/ad/ryytn15257492.png",
        "fb_wbq199-130"      => "https://cdn.haowuji123.com/upload/ad/wbq15226477.png",
        "fb_hs199-130"       => "https://cdn.haowuji123.com/upload/ad/hs15226356.png",
        "fb_wd199-115"       => "https://cdn.haowuji123.com/upload/ad/wd15251635.png",
        "fb_bw99-60"         => "https://cdn.haowuji123.com/upload/ad/bw15274615_1113_2.png",
        "fb_qq199-130"       => "https://cdn.haowuji123.com/upload/ad/qq15274600.png",
        "fb_lyl199-105"      => "https://cdn.haowuji123.com/upload/ad/lyl15262130_1110.png",
        "fb_lyf399-305"      => "https://cdn.haowuji123.com/upload/ad/lyf15226281.png",
    ];

    const MAIN_PIC_DEFAULT = "https://cdn.haowuji123.com/upload/ad/xxxx.png";

    //品牌
    const PING_PAI = [
        "维达"    => "wd",
        "百雀羚"   => "bql",
        "温碧泉"   => "wbq",
        "韩束"    => "hs",
        "洽洽"    => "qq",
        "蓝月亮"   => "lyl",
        "来伊份"   => "lyf",
        "南极人内衣" => "njr",
        "法兰琳卡"  => "fllk",
        "认养一头牛" => "ryytn",
        "百草味"   => "bcw",
        "霸王"    => "bw",
        "活动页"   => "hdy",
        "天图pro" => "ttpro",
        "一叶子"   => "yyz",
        "三生花"   => "ssh",
        "香飘飘"   => "xpp"
    ];


    //品牌logo
    const PING_LOGO = [
        "维达"    => "https://cdn.haowuji123.com/upload/ad/wd_logo.jpeg",
        "百雀羚"   => "https://cdn.haowuji123.com/upload/ad/bql_logo.jpeg",
        "温碧泉"   => "https://cdn.haowuji123.com/upload/ad/wbq_logo.png",
        "韩束"    => "https://cdn.haowuji123.com/upload/ad/hs_logo.png",
        "洽洽"    => "https://cdn.haowuji123.com/upload/ad/qq_logo.jpeg",
        "蓝月亮"   => "https://cdn.haowuji123.com/upload/ad/lyl_logo.png",
        "来伊份"   => "https://cdn.haowuji123.com/upload/ad/lyf_logo.jpeg",
        "南极人内衣" => "https://cdn.haowuji123.com/upload/ad/njr_logo.png",
        "法兰琳卡"  => "https://cdn.haowuji123.com/upload/ad/fllk_logo.jpeg",
        "认养一头牛" => "https://cdn.haowuji123.com/upload/ad/ryytn_logo.jpeg",
        "百草味"   => "https://cdn.haowuji123.com/upload/ad/bcw_logo.jpeg",
        "霸王"    => "https://cdn.haowuji123.com/upload/ad/bw_logo.jpeg",
        "活动页"   => "https://cdn.haowuji123.com/upload/ad/xxx.jpeg",
        "天图pro" => "https://cdn.haowuji123.com/upload/ad/xxx.jpeg",
        "一叶子" => "https://cdn.haowuji123.com/upload/ad/xxx.jpeg"
    ];

}
