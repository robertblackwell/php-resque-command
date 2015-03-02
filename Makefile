#makefile
BINDIR := ~/bin
BUILDDIR:=	build
PHARNAME := resque_cmd.phar
TARGET := 	build/$(PHARNAME)
PHARIZER := scripts/create-phar.php
SRCPREFIX := `pwd`

php :=  $(shell find src -type f -name "*.php") $(shell find vendor -type f -name "*.php")  


$(TARGET): Makefile $(PHARIZER) $(php)
	# create the phar
	$(PHARIZER) $(TARGET) $(SRCPREFIX) src/Stub.php src vendor 
	#make it executable
	chmod 775 $(TARGET)

install:
	cp -v $(TARGET) $(BINDIR)/$(PHARNAME)

clean:
	rm -v $(BUILDDIR)/*