class Assets {

  constructor() {

    this.flags = {
      jquery: false
    };

    this.entries = {};
  }

  add( name, path ) {

    Object.assign( this.entries, {[name]: path });

    return this;
  }

  enable(flag) {

    if (this.flags[flag]) {

      this.flags[flag] = true;
    }
  }

  disable(flag) {

    if (this.flags[flag]) {

      this.flags[flag] = false;
    }
  }
}

exports.config = new Assets();

