FROM hyperf/hyperf:8.0-alpine-v3.12-swoole


# 创建目录
RUN set -x \
	&& mkdir /code \
	&& cd /code

# 设置工作目录
WORKDIR /code

# 将代码复制到容器中
COPY . .

# 暴露端口
EXPOSE 9501

# 启动命令
ENTRYPOINT ["/usr/bin/php", "/code/bin/hyperf.php", "start"]
