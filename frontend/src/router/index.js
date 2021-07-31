import Vue from "vue";
import VueRouter from "vue-router";
Vue.use(VueRouter);
const router = new VueRouter({
    mode: "history",
    base: process.env.BASE_URL,
    scrollBehavior() {
        return { x: 0, y: 0 };
    },
    routes: [
        {
            path: "/hello-world",
            name: "hello-world",
            component: () => import("../components/HelloWorld.vue"),
            meta: {
                pageTitle: "Hello Word",
                breadcrumb: [
                    {
                        text: "Hello Word",
                        active: true
                    }
                ],
                requiresAuth: true
            }
        },
        {
            path: "/test",
            name: "test",
            component: () => import("..//components/Test.vue"),
            meta: {
                pageTitle: "Test",
                breadcrumb: [
                    {
                        text: "Test",
                        active: true
                    }
                ],
                requiresAuth: true
            }
        }
    ]
});
export default router