<?php
use Propel\Generator\Manager\MigrationManager;

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1637165147.
 * Generated on 2021-11-17 16:05:47  
 */
class PropelMigration_1637165147 
{
    public $comment = '';

    public function preUp(MigrationManager $manager)
    {
        // add the pre-migration code here
    }

    public function postUp(MigrationManager $manager)
    {
        // add the post-migration code here
    }

    public function preDown(MigrationManager $manager)
    {
        // add the pre-migration code here
    }

    public function postDown(MigrationManager $manager)
    {
        // add the post-migration code here
    }

    /**
     * Get the SQL statements for the Up migration
     *
     * @return array list of the SQL strings to execute for the Up migration
     *               the keys being the datasources
     */
    public function getUpSQL()
    {
        $connection_default = <<< 'EOT'

BEGIN;

CREATE TABLE "public"."users"
(
    "id" serial NOT NULL,
    "name" VARCHAR(255) NOT NULL,
    "surname" VARCHAR(255) NOT NULL,
    "email" VARCHAR(255) NOT NULL,
    "description" VARCHAR(255),
    "hash" VARCHAR(255),
    "status" INTEGER,
    "created_at" TIMESTAMP,
    "updated_at" TIMESTAMP,
    "deleted_at" TIMESTAMP,
    "created_by" INTEGER,
    "updated_by" INTEGER,
    "deleted_by" INTEGER,
    PRIMARY KEY ("id")
);

CREATE TABLE "public"."usergroups"
(
    "group_id" serial NOT NULL,
    "group_name" VARCHAR(100) NOT NULL,
    "created_at" TIMESTAMP,
    "updated_at" TIMESTAMP,
    "deleted_at" TIMESTAMP,
    "created_by" INTEGER,
    "updated_by" INTEGER,
    "deleted_by" INTEGER,
    PRIMARY KEY ("group_id")
);

CREATE TABLE "public"."user_permissions"
(
    "pid" serial NOT NULL,
    "permission_name" VARCHAR(255) NOT NULL,
    "permission_type" INTEGER,
    "userid" INTEGER,
    "created_at" TIMESTAMP,
    "updated_at" TIMESTAMP,
    "deleted_at" TIMESTAMP,
    "created_by" INTEGER,
    "updated_by" INTEGER,
    "deleted_by" INTEGER,
    PRIMARY KEY ("pid")
);

CREATE TABLE "public"."group_permissions"
(
    "pid" serial NOT NULL,
    "permission_name" VARCHAR(255) NOT NULL,
    "permission_type" INTEGER,
    "userid" INTEGER,
    "created_at" TIMESTAMP,
    "updated_at" TIMESTAMP,
    "deleted_at" TIMESTAMP,
    "created_by" INTEGER,
    "updated_by" INTEGER,
    "deleted_by" INTEGER,
    PRIMARY KEY ("pid")
);

COMMIT;
EOT;

        return array(
            'default' => $connection_default,
        );
    }

    /**
     * Get the SQL statements for the Down migration
     *
     * @return array list of the SQL strings to execute for the Down migration
     *               the keys being the datasources
     */
    public function getDownSQL()
    {
        $connection_default = <<< 'EOT'

BEGIN;

DROP TABLE IF EXISTS "public"."users" CASCADE;

DROP TABLE IF EXISTS "public"."usergroups" CASCADE;

DROP TABLE IF EXISTS "public"."user_permissions" CASCADE;

DROP TABLE IF EXISTS "public"."group_permissions" CASCADE;

COMMIT;
EOT;

        return array(
            'default' => $connection_default,
        );
    }

}