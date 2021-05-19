import pymysql
miConexion = pymysql.connect( host='localhost', user= 'edy', passwd='123', db='ampip' )
cur = miConexion.cursor()
cur.execute( "SELECT * FROM user" )
print(cur)
miConexion.close()
