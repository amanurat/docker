FROM nanfei/wrap_docker

# install java
RUN apt-get install java-1.7.0-openjdk
ENV JAVA_HOME /usr/lib/jvm/jre

# install maven
ENV MAVEN_VERSION 3.2.3

RUN curl -sSL http://archive.apache.org/dist/maven/maven-3/$MAVEN_VERSION/binaries/apache-maven-$MAVEN_VERSION-bin.tar.gz | tar xzf - -C /usr/share \
  && mv /usr/share/apache-maven-$MAVEN_VERSION /usr/share/maven \
  && ln -s /usr/share/maven/bin/mvn /usr/bin/mvn

ENV MAVEN_HOME /usr/share/maven

# set up workspace
RUN mkdir /workspace
ENV WS /workspace

# build script
RUN mkdir /tools
RUN chmod +w /tools
ADD ./build.sh /tools/build.sh
RUN chmod +x /tools/build.sh

CMD ["java -version"]
