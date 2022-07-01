make:
	docker build  -t registry.cn-beijing.aliyuncs.com/jimmyci/gin-blog:latest .
	docker push registry.cn-beijing.aliyuncs.com/jimmyci/gin-blog:latest
