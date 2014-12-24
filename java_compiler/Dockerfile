FROM nanfei/maven

# set up workspace
RUN mkdir /workspace
ENV WS /workspace
WORKDIR ${WS}
RUN git config --global http.sslVerify false

# build script
RUN mkdir /tools
RUN chmod +w /tools
ADD ./build.sh /tools/build.sh
RUN chmod +x /tools/build.sh

CMD ["/tools/build.sh"]
