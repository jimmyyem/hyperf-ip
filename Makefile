make:
	docker build  -t registry.cn-beijing.aliyuncs.com/jimmyci/hyperf-ip:latest .
	docker push registry.cn-beijing.aliyuncs.com/jimmyci/hyperf-ip:latest
