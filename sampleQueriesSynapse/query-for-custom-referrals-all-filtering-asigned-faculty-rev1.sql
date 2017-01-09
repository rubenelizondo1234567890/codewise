select SQL_CALC_FOUND_ROWS p.id , p.id, p.firstname, p.lastname, p.risk_level, rml.risk_model_id, ops.status as student_status, il.image_name as intent_imagename,il.text as intent_text, rl.image_name as risk_imagename, rl.risk_text as risk_text, (count(distinct (lc.id))) as login_cnt, p.cohert, p.last_activity, r.id as rid, p.userName as primary_email, pem.metadata_value as class_level, pem.metadata_value as class_level, r.person_id_faculty as faculty, r.person_id_assigned_to as faculty_assigned  from person p

          left join risk_level rl on (p.risk_level = rl.id)
          left join risk_model_levels rml on (rml.risk_level = rl.id)
          left join intent_to_leave il on (p.intent_to_leave = il.id)
          left join referrals r on (p.id = r.person_id_student)
          left join org_person_student ops on (p.id = ops.person_id)
          left outer join activity_log lc on (lc.person_id_student = p.id)
          left join person_ebi_metadata pem on 
                (pem.person_id = p.id and pem.ebi_metadata_id= 56 
                    /* and pem.org_academic_year_id = 34 */)
          where  p.id in (
 
        /* Students accessible to Faculty with ID 231679 */
        
            SELECT DISTINCT
                merged.student_id
            FROM
                (
                    /* Students associated with Faculty via Groups */
                    SELECT
                        S.person_id AS student_id,
                        F.org_permissionset_id AS permissionset_id
                    FROM 
                        org_group_students AS S
                        INNER JOIN org_group_faculty AS F
                            ON F.org_group_id = S.org_group_id and F.deleted_at is null
                    WHERE
                        S.organization_id = 20
                        AND S.deleted_at is null
                        AND F.person_id = 231679
                        AND F.deleted_at is null
    
                    UNION ALL
                    
                    /* Students associated with Faculty via Courses */
                    SELECT
                        S.person_id AS student_id,
                        F.org_permissionset_id AS permissionset_id
                    FROM 
                        org_course_student AS S
                        INNER JOIN org_courses AS C
                            ON C.id = S.org_courses_id AND C.deleted_at is null
                        INNER JOIN org_course_faculty AS F
                            ON F.org_courses_id = S.org_courses_id AND F.deleted_at is null
                        INNER JOIN org_academic_terms AS OAT
                            ON OAT.id = C.org_academic_terms_id 
                                AND OAT.deleted_at is null
                                AND DATE(now()) 
                                    between STR_TO_DATE( OAT.start_date, "%Y-%m-%d") 
                                        and STR_TO_DATE( OAT.end_date, "%Y-%m-%d")
                    WHERE
                        S.organization_id = 20
                        AND S.deleted_at is null
                        AND F.organization_id = 20
                        AND F.deleted_at is null
                        AND F.person_id = 231679
                ) AS merged
                INNER JOIN org_person_student AS S
                    ON S.person_id = merged.student_id 
                        AND S.deleted_at IS NULL
                        AND S.organization_id = 20
                INNER JOIN org_permissionset OPS
                    ON OPS.id = merged.permissionset_id AND OPS.deleted_at is null
                        AND OPS.accesslevel_ind_agg = 1
         
 /* Query restricting students access for faculty ends */ 
 
) 
 AND  p.id in (
 /* Select students having atleast one referral in specified status */
        
            select
               rr.person_id_student
            from
                referrals rr             
            where
                rr.organization_id = 20
)  
AND (r.person_id_assigned_to = 231679 OR r.person_id_faculty = 231679)
and p.deleted_at is null
and r.deleted_at is null
AND r.status IN ('O','C')
group by (p.id) 
order by p.risk_level asc ,p.lastname,p.firstname 
LIMIT 0 , 2500;