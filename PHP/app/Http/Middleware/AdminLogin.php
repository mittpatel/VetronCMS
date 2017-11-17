<?php

namespace App\Http\Middleware;


use Closure;

class AdminLogin {

    public function handle($request, Closure $next) {

        if (!session()->has('vetronCmsLogin')) {
            session(['beforeLanding' => $request->fullUrl()]);

            return redirect('admin/login');
        }

        $userInfo = session('vetronCmsLogin');
        define('GID', $userInfo->g_id);
        define('UID', $userInfo->id);
		
		$urlAuth = $request->route()->getAction()['auth'];

		if($urlAuth){
			$menuLists = \App\Http\Model\Admin\Menu::where(['auth' => $urlAuth])->first()->toarray();
			//网站标题
			$GLOBALS['language_key'] = $menuLists['language_key'];
		}        
		
//      跳过超级管理员
        if (UID != 1 && GID != 0) {

            //用户已经加入的组(且组状态正常)
            $groupAuth = \App\Http\Model\Admin\AdminGroup::where(['status' => 1])->whereIn('id', explode(',', GID))->get();

            $tmpArrStr = null;
            foreach ($groupAuth as $groupAuthOne) {
                $tmpArrStr .= $groupAuthOne->auth_list . ',';
            }

            //去重权限
            $groupAuthArr = array_unique(array_filter(explode(',', $tmpArrStr)));

            
            //只查询具有权限的菜单
            $GLOBALS['menuDate'] = \App\Http\Model\Admin\Menu::where(['is_show' => 1])->whereIn('id', $groupAuthArr)->orderby('order','asc')->get();

            if ($urlAuth) {
                if (!in_array($menuLists['id'], $groupAuthArr)) {
                    return back()->with('tips', admin_language('auth_NoPermissions'));
                }
                //验证通过
            }
        } else {
            $GLOBALS['menuDate'] = \App\Http\Model\Admin\Menu::where(['is_show' => 1])->orderby('order','asc')->get();
        }
		
        //后台语言
        $GLOBALS['languageList'] = \App\Http\Model\Admin\Language::where(['status' => 1, 'modular' => 2])->get();

        return $next($request);
    }
}
