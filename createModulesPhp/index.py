class createPhp:


    def __init__(self, name, repo, module):
        self.name = name
        self.module = module
        self.repo = repo

        vars = self.createVars()
        getting = self.createGettirn()
        setting = self.createSetting()
        self.createDocument(vars,getting,setting, name, repo, module)

    def createVars(self):
        import csv
        fields = ""
        with open('fields.csv') as File:
            reader = csv.reader(File)
            for row in reader:
                if row[0] != "":
                    name = row[0]
                    temp = f"""
                         /**
                         * @ORM\Column(name="{name}")
                         */
                     protected ${name};"""
                    fields = fields + temp
                else:
                    print("bacio")
        return fields

    def createGettirn(self):
        import csv
        fields = ""
        with open('fields.csv') as File:
            reader = csv.reader(File)
            for row in reader:
                if row[0] != "":
                    name = row[0]
                    type = row[1]
                    keyOpen = "{"
                    keyClose = "}"
                    temp = f"""
                        /**
                         * Returns {name}.
                         * @return {type}
                         */
                        public function get{name}(){keyOpen} return $this->{name};{keyClose}

                        """
                    fields = fields + temp
                else:
                    print("bacio")
        return fields

    def createSetting(self):
        import csv
        fields = ""
        with open('fields.csv') as File:
            reader = csv.reader(File)
            for row in reader:
                if row[0] != "":
                    name = row[0]
                    keyOpen = "{"
                    keyClose = "}"
                    temp = f"""
                        /**
                         * Sets {name}
                         * @param int ${name}
                         */
                        public function set{name}(${name}){keyOpen}$this->{name} = ${name};{keyClose}
                        """
                    fields = fields + temp
                else:
                    print("bacio")
        return fields

    def createDocument(self, vars, getting , setting, name, repo, module):

        f = open(f'../module/{module}/src/Entity/{name}Entity.php', 'w')

        with open('index.php') as File:

            for row in File:
                clasName = row.replace("${0}", module)
                classes = clasName.replace("${3}", name+"Entity")
                nam = classes.replace("${1}",f"{repo}Repository")
                rep = nam.replace("${2}", name)
                protected = rep.replace("${protected}", vars)
                getter = protected.replace("${getter}", getting)
                setter = getter.replace("${setter}", setting)
                f.write(setter)

name = input("nombre de la entidad el mismo de la tabla de bases de datos ")
repository = input("repositorio de la entidad ")
module = input("nombre del modulo donde se creara el repository ")

if name == "" and repository == "" and module == "":
    create = createPhp("prueba","prueba", "modulo")
else:
    create = createPhp(name, repository, module)