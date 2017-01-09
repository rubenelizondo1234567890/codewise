select SQL_CALC_FOUND_ROWS p.id ,
 p.id, p.firstname, 
 p.lastname, 
 p.risk_level, 
 rml.risk_model_id, 
 ops.status as student_status, 
 il.image_name as intent_imagename,
 il.text as intent_text, 
 rl.image_name as risk_imagename, 
 rl.risk_text as risk_text, 
 (count(distinct (lc.id))) as login_cnt, 
 p.cohert,        
        (select
		(case 
			when (activity_type='N') then concat(DATE_FORMAT(activity_date,'%m/%d/%y'), ' - ','Note')
			when (activity_type='A') then concat(DATE_FORMAT(activity_date,'%m/%d/%y'), ' - ','Appointment')
			when (activity_type='C') then concat(DATE_FORMAT(activity_date,'%m/%d/%y'), ' - ','Contact')
			when (activity_type='E') then concat(DATE_FORMAT(activity_date,'%m/%d/%y'), ' - ','Email')
			when (activity_type='R') then concat(DATE_FORMAT(activity_date,'%m/%d/%y'), ' - ','Referral')
			else concat(DATE_FORMAT(activity_date,'%m/%d/%y'), ' - ','Login')
		END) as new
        from activity_log aal where aal.id =  max(lc.id) AND lc.deleted_at is null
	) as last_activity ,
 r.id as rid, p.userName as primary_email, 
 pem.metadata_value as class_level  
from person p

          left join risk_level rl on (p.risk_level = rl.id)
          left join risk_model_levels rml on (rml.risk_level = rl.id)
          left join intent_to_leave il on (p.intent_to_leave = il.id)
          left join referrals r on (p.id = r.person_id_student and  r.deleted_at is null)
          left join org_person_student ops on (p.id = ops.person_id)
          left outer join activity_log lc on (lc.person_id_student = p.id and lc.deleted_at is null)
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
                                    between OAT.start_date
                                        and OAT.end_date
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
 /* Select students having an academic update with specified values in the given period */
            select distinct au.person_id
            from
                (select distinct au.person_id_student as person_id, au.org_courses_id
					from academic_update au
					where au.org_id = 20
                	and au.deleted_at is null
                    and au.status = "closed"
                	and DATE(au.update_date) between STR_TO_DATE( "2015-08-17", "%Y-%m-%d") and STR_TO_DATE( "2016-08-15", "%Y-%m-%d")
					and  au.grade in ( "A","B","C","D","F","P","N/A" ) 
                 ) as au
			 where au.org_courses_id in
                    (            
                    /* Check permission of Staff to view academic update on the course */
            
                    select distinct org_courses_id
                    from org_course_faculty ocf
                    where ocf.organization_id = 20
					and ocf.person_id = 231679
					and deleted_at is null
					and org_permissionset_id in 
						(select id
							from org_permissionset ops
                            where ops.organization_id = 20
							and deleted_at is null 
							and ( create_view_academic_update = 1 or view_all_academic_update_courses = 1 )
                        )
            
                    /* Check permission of Staff to view academic update on the course - ends */
                    )
                or au.person_id in
                    (            
                    /* Check permission of Staff to view academic update on any course */
            
                    select
                        distinct s.person_id
                    from 
                        org_group_students as s
                        INNER JOIN org_group_faculty as f
                            ON f.org_group_id = s.org_group_id and f.deleted_at is null
                    where
                        s.organization_id = 20
                        and s.deleted_at is null
                        and f.person_id = 231679
                        and f.deleted_at is null
                        and f.org_permissionset_id in (
                            select 
                                id
                            from
                                org_permissionset ops
                            where
                                ops.organization_id = 20
                                and deleted_at is null 
                                and ( create_view_academic_update = 1 or view_all_academic_update_courses = 1 )
                        )            
                    /* Check permission of Staff to view academic update on any course - ends */
                    )            
        
) 
 AND  p.id in (
 /* Select students having an academic update with specified values in the given period */
            select
                distinct au.person_id
            from
                (            
                select
                	distinct au.person_id_student as person_id, au.org_courses_id
                from
                	academic_update au
                where
                	au.org_id = 20
                	and au.deleted_at is null
                    and au.status = "closed"
                	and DATE(au.update_date) between 
                			STR_TO_DATE( "2015-08-17", "%Y-%m-%d") 
                			and STR_TO_DATE( "2016-08-15", "%Y-%m-%d")

                    and  au.update_date is not null 
                ) as au
            where
                au.org_courses_id in
                    (            
                    /* Check permission of Staff to view academic update on the course */
            
                    select distinct
                        org_courses_id
                    from
                        org_course_faculty ocf
                    where
                        ocf.organization_id = 20
                        and ocf.person_id = 231679
                        and deleted_at is null
                        and org_permissionset_id in (
                            select 
                                id
                            from
                                org_permissionset ops
                            where
                                ops.organization_id = 20
                                and deleted_at is null 
                                and ( create_view_academic_update = 1 or view_all_academic_update_courses = 1 )
                        )
            
                    /* Check permission of Staff to view academic update on the course - ends */
                    )
                or au.person_id in
                    (            
                    /* Check permission of Staff to view academic update on any course */
            
                    select
                        distinct s.person_id
                    from 
                        org_group_students as s
                        INNER JOIN org_group_faculty as f
                            ON f.org_group_id = s.org_group_id and f.deleted_at is null
                    where
                        s.organization_id = 20
                        and s.deleted_at is null
                        and f.person_id = 231679
                        and f.deleted_at is null
                        and f.org_permissionset_id in (
                            select 
                                id
                            from
                                org_permissionset ops
                            where
                                ops.organization_id = 20
                                and deleted_at is null 
                                and ( create_view_academic_update = 1 or view_all_academic_update_courses = 1 )
                        )            
                    /* Check permission of Staff to view academic update on any course - ends */
                    )            
        
) 
and p.deleted_at is null  
group by (p.id) 
order by p.risk_level asc ,p.lastname,p.firstname 
LIMIT 0 , 2500;