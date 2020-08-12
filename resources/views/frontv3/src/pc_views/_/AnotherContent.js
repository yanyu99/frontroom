export default (componentTag => {
    if(componentTag == 'test123') {
        return () => import('@/pc_views/test123/AnotherContent.vue');
    }
    return () => import('@/pc_views/default/AnotherContent.vue');
})(typeof D == "object" ? (D.componentMap['AnotherContent'] || D.componentTag || 'default') : 'default');