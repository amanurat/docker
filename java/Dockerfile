FROM nanfei/wrap_docker

ENV JAVA_HOME /usr/lib/jvm/java-7-oracle

RUN true \
  && apt-get update \
  && apt-get -y install curl ca-certificates \
  \
  && mkdir -p ${JAVA_HOME} \
  && \
    curl \
      -s -H "Cookie: oraclelicense=accept-securebackup-cookie" \
      -L http://download.oracle.com/otn-pub/java/jdk/7u67-b01/jdk-7u67-linux-x64.tar.gz \
      -o jdk.tar.gz \
  && \
    if [ "`md5sum jdk.tar.gz | cut -d ' ' -f 1`" = "81e3e2df33e13781e5fac5756ed90e67" ]; then \
      tar -xvf jdk.tar.gz -C ${JAVA_HOME} --strip-components 1; \
      rm -rf jdk.tar.gz; \
    else \
      echo "checksum mismatch" 1>&2; \
      exit 1; \
    fi \
  \
  && apt-get -y purge curl ca-certificates \
  && apt-get -y autoremove \
  && rm -rf /var/lib/apt/lists/* \
  \
  && \
    for binary in `ls ${JAVA_HOME}/bin`; do \
      if [ ! -z "${binary##*.*}" ] && [ ! -f /usr/bin/$binary ]; then \
        update-alternatives --install \
          /usr/bin/$binary $binary ${JAVA_HOME}/bin/$binary 100; \
      fi \
    done
